<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerShippingFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_processing_order_page_shows_required_shipping_form_fields(): void
    {
        $seller = User::factory()->seller()->create();
        $buyer = User::factory()->buyer()->create();
        $product = Product::factory()->create(['user_id' => $seller->id]);

        $order = Order::factory()->create([
            'user_id' => $buyer->id,
            'status' => 'processing',
            'payment_status' => 'paid',
        ]);

        OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'seller_id' => $seller->id,
        ]);

        $response = $this->actingAs($seller)->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertSee('shipping_provider');
        $response->assertSee('tracking_number');
        $response->assertSee('shipping_proof_photo');
    }

    public function test_seller_can_mark_order_as_shipped_when_shipping_columns_exist(): void
    {
        $seller = User::factory()->seller()->create();
        $buyer = User::factory()->buyer()->create();
        $product = Product::factory()->create(['user_id' => $seller->id]);

        $order = Order::factory()->create([
            'user_id' => $buyer->id,
            'status' => 'processing',
            'payment_status' => 'paid',
        ]);

        OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'seller_id' => $seller->id,
        ]);

        $response = $this->actingAs($seller)
            ->from(route('orders.show', $order))
            ->patch(route('orders.update-status', $order), [
                'status' => 'shipped',
                'shipping_provider' => 'J&T',
                'tracking_number' => 'ECO-TEST-123',
                'shipping_proof_photo' => \Illuminate\Http\UploadedFile::fake()->image('shipping-proof.png'),
            ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'shipped',
            'shipping_provider' => 'J&T',
            'tracking_number' => 'ECO-TEST-123',
            'shipping_status' => 'sent',
        ]);
    }

    public function test_get_order_status_route_redirects_to_order_detail(): void
    {
        $seller = User::factory()->seller()->create();
        $buyer = User::factory()->buyer()->create();
        $product = Product::factory()->create(['user_id' => $seller->id]);

        $order = Order::factory()->create([
            'user_id' => $buyer->id,
            'status' => 'processing',
            'payment_status' => 'paid',
        ]);

        OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'seller_id' => $seller->id,
        ]);

        $response = $this->actingAs($seller)->get('/orders/' . $order->id . '/status');

        $response->assertRedirect(route('orders.show', $order));
        $response->assertStatus(302);
    }

    public function test_seller_order_total_uses_order_amount_from_checkout(): void
    {
        $order = Order::factory()->create([
            'total_amount' => 25000,
            'status' => 'processing',
        ]);

        $this->assertSame(25000.0, (float) $order->total);
        $this->assertSame(25000.0, (float) $order->total_amount);
    }

    public function test_order_carbon_saved_uses_order_items_when_order_value_is_zero(): void
    {
        $order = Order::factory()->create([
            'total_carbon_saved' => 0,
            'status' => 'processing',
        ]);

        OrderItem::factory()->create([
            'order_id' => $order->id,
            'quantity' => 1,
            'carbon_saved' => 2.5,
        ]);

        OrderItem::factory()->create([
            'order_id' => $order->id,
            'quantity' => 1,
            'carbon_saved' => 2.5,
        ]);

        $this->assertSame(5.0, (float) $order->fresh()->carbon_saved);
    }
}
