<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Payment status
            $table->string('payment_ref')->nullable()->after('payment_method');
            $table->string('payment_status')->default('pending')->after('payment_ref'); // pending, paid, failed, expired
            $table->string('payment_notes')->nullable()->after('payment_status');
            $table->timestamp('payment_paid_at')->nullable()->after('payment_notes');
            $table->timestamp('payment_expires_at')->nullable()->after('payment_paid_at');

            // Add indexes for payment queries
            $table->index('payment_status');
            $table->index('payment_ref');
            $table->index(['payment_status', 'payment_expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['payment_status']);
            $table->dropIndex(['payment_ref']);
            $table->dropIndex(['payment_status', 'payment_expires_at']);

            $table->dropColumn([
                'payment_ref',
                'payment_status',
                'payment_notes',
                'payment_paid_at',
                'payment_expires_at',
            ]);
        });
    }
};
