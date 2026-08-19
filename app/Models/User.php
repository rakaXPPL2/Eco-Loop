<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'address',
        'avatar',
        'total_carbon_saved',
        'total_vouchers',
        'total_orders',
        'role',
        'is_blocked',
        'region_id',
        'store_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'total_carbon_saved' => 'decimal:4',
            'total_vouchers' => 'integer',
            'total_orders' => 'integer',
            'store_completed' => 'boolean',
            'is_blocked' => 'boolean',
        ];
    }

    // Relationships
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
                    ->using(UserBadge::class)
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }

    public function redemptions(): HasMany
    {
        return $this->hasMany(Redemption::class);
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    // Role checks
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSeller(): bool
    {
        return $this->role === 'seller';
    }

    public function isBuyer(): bool
    {
        return $this->role === 'buyer';
    }

    // Permissions - SELLER CAN ONLY SELL, CANNOT BUY
    public function canSell(): bool
    {
        return $this->role === 'seller';
    }

    public function canBuy(): bool
    {
        // Only BUYERS can buy, NOT sellers
        return $this->role === 'buyer';
    }

    // Admin can manage but cannot buy
    public function canManageAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Check if seller has completed store profile
    public function hasStoreProfile(): bool
    {
        return $this->store && $this->store->name !== null;
    }

    public function addCarbonSaved(float $amount): void
    {
        $this->increment('total_carbon_saved', $amount);
    }

    public function addVoucher(int $points): void
    {
        $this->increment('total_vouchers', $points);
    }

    public function incrementOrders(): void
    {
        $this->increment('total_orders');
    }

    public function getActiveVouchersAttribute()
    {
        return $this->vouchers()->active()->get();
    }

    public function getUnreadNotificationsAttribute()
    {
        return $this->notifications()->unread()->get();
    }

    public function getUnreadMessagesAttribute()
    {
        return $this->receivedMessages()->where('is_read', false)->count();
    }

    public function getRankAttribute(): int
    {
        // Cache-friendly: use a single query to count users with higher carbon saved
        // For better performance on large datasets, consider using a computed/cached rank column
        return static::where('total_carbon_saved', '>', $this->total_carbon_saved)->count() + 1;
    }

    public function getCartItemCountAttribute(): int
    {
        return $this->cart?->item_count ?? 0;
    }
}
