<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageStoreRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_seller_can_send_message_to_buyer_via_messages_store_route(): void
    {
        $seller = User::factory()->create(['role' => 'seller']);
        $buyer = User::factory()->create(['role' => 'buyer']);

        $response = $this->actingAs($seller)->post(route('messages.store'), [
            'receiver_id' => $buyer->id,
            'message' => 'Halo, pesananmu sedang diproses.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('messages', [
            'sender_id' => $seller->id,
            'receiver_id' => $buyer->id,
            'content' => 'Halo, pesananmu sedang diproses.',
        ]);
    }
}
