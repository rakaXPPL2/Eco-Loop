<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\Voucher;
use App\Models\Notification;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     * Award badges and vouchers when an order is completed.
     */
    public function updated(Order $order): void
    {
        if ($order->wasChanged('status') && $order->status === 'completed') {
            $this->awardVouchers($order);
            $this->awardBadges($order);
        }
    }

    /**
     * Award vouchers to the buyer based on carbon saved.
     * Points = carbon_saved * 10 (10 points per kg CO2)
     */
    protected function awardVouchers(Order $order): void
    {
        $user = $order->user;

        if (!$user) {
            return;
        }

        // Calculate points based on carbon saved (10 points per kg CO2)
        $points = (int) ($order->total_carbon_saved * 10);

        if ($points > 0) {
            // Create voucher record
            Voucher::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'code' => Voucher::generateCode(),
                'carbon_amount' => $order->total_carbon_saved,
                'points' => $points,
                'status' => 'active',
                'expires_at' => now()->addDays(30),
            ]);

            // Add points to user's balance
            $user->addVoucher($points);

            // Send notification
            Notification::create([
                'user_id' => $user->id,
                'type' => 'reward',
                'title' => 'Voucher Karbon Diraih!',
                'message' => "Pesanan {$order->order_number} selesai! +{$points} voucher karbon ({$order->total_carbon_saved} kg CO2)",
                'is_read' => false,
            ]);
        }

        // Award sellers for their part of the order
        foreach ($order->items->groupBy('seller_id') as $sellerId => $items) {
            $sellerCarbon = $items->sum('carbon_saved');
            $sellerPoints = (int) ($sellerCarbon * 10);

            if ($sellerPoints > 0) {
                // Create voucher for seller
                Voucher::create([
                    'user_id' => $sellerId,
                    'order_id' => $order->id,
                    'code' => Voucher::generateCode(),
                    'carbon_amount' => $sellerCarbon,
                    'points' => $sellerPoints,
                    'status' => 'active',
                    'expires_at' => now()->addDays(30),
                ]);

                // Add points to seller's balance
                $seller = \App\Models\User::find($sellerId);
                if ($seller) {
                    $seller->addVoucher($sellerPoints);

                    // Notify seller
                    Notification::create([
                        'user_id' => $sellerId,
                        'type' => 'reward',
                        'title' => 'Voucher Penjualan!',
                        'message' => "Pesanan {$order->order_number} selesai! +{$sellerPoints} voucher karbon",
                        'is_read' => false,
                    ]);
                }
            }
        }
    }

    /**
     * Award badges to the buyer based on carbon saved milestones.
     */
    protected function awardBadges(Order $order): void
    {
        $user = $order->user;

        if (!$user) {
            return;
        }

        // Get all active badges that the user hasn't earned yet
        $eligibleBadges = Badge::active()
            ->get()
            ->filter(function (Badge $badge) use ($user) {
                // Check if user already has this badge
                $alreadyHas = UserBadge::where('user_id', $user->id)
                    ->where('badge_id', $badge->id)
                    ->exists();

                // Check if user meets the eligibility criteria
                $eligible = $badge->checkEligibility($user);

                return !$alreadyHas && $eligible;
            });

        // Award each eligible badge
        foreach ($eligibleBadges as $badge) {
            UserBadge::awardBadge($user, $badge);
        }
    }
}
