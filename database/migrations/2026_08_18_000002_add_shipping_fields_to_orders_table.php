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
            $table->string('shipping_provider')->nullable()->after('notes');
            $table->string('tracking_number')->nullable()->after('shipping_provider');
            $table->enum('shipping_status', ['pending', 'sent', 'received'])->default('pending')->after('tracking_number');
            $table->string('seller_shipping_proof_photo')->nullable()->after('shipping_status');
            $table->string('buyer_received_photo')->nullable()->after('seller_shipping_proof_photo');
            $table->timestamp('seller_sent_at')->nullable()->after('buyer_received_photo');
            $table->timestamp('buyer_received_at')->nullable()->after('seller_sent_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_provider',
                'tracking_number',
                'shipping_status',
                'seller_shipping_proof_photo',
                'buyer_received_photo',
                'seller_sent_at',
                'buyer_received_at',
            ]);
        });
    }
};
