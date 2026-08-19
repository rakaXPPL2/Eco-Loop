<?php

namespace Tests\Feature;

use App\Models\Redemption;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRedemptionAndStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_statistics_page_loads_for_admin_user(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('admin.statistics'));

        $response->assertOk();
    }

    public function test_admin_statistics_view_renders_without_errors_bag(): void
    {
        User::factory()->admin()->create();

        $view = view('eco-loop.pages.admin.statistics', [
            'stats' => [
                'total_users' => 0,
                'total_sellers' => 0,
                'total_buyers' => 0,
                'total_products' => 0,
                'total_orders' => 0,
                'total_revenue' => 0,
                'total_carbon' => 0,
                'total_stores' => 0,
                'pending_stores' => 0,
                'pending_complaints' => 0,
            ],
            'monthlyTrends' => ['labels' => [], 'data' => []],
            'categoryPerformance' => collect(),
            'topSellers' => collect(),
            'topBuyers' => collect(),
            'carbonByMonth' => ['labels' => [], 'data' => []],
            'orderStatusDistribution' => [
                'pending' => 0,
                'processing' => 0,
                'shipped' => 0,
                'completed' => 0,
                'cancelled' => 0,
            ],
            'revenueByRegion' => collect(),
            'growthMetrics' => [
                'revenue' => ['current' => 0, 'last' => 0, 'growth' => 0],
                'orders' => ['current' => 0, 'last' => 0, 'growth' => 0],
                'new_users' => ['current' => 0, 'last' => 0, 'growth' => 0],
            ],
        ]);

        $rendered = $view->render();

        $this->assertStringContainsString('Statistik Platform', $rendered);
    }

    public function test_reward_redemption_can_be_created_and_approved_by_admin(): void
    {
        $user = User::factory()->buyer()->create([
            'total_vouchers' => 200,
        ]);

        $reward = Reward::factory()->create([
            'points_required' => 100,
            'stock' => 10,
            'is_active' => true,
        ]);

        $this->actingAs($user)
            ->post(route('eco-shop.redeem'), ['reward_id' => $reward->id])
            ->assertSessionHas('success');

        $redemption = Redemption::first();

        $this->assertNotNull($redemption);
        $this->assertSame('pending', $redemption->status);

        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->post(route('admin.redemptions.approve', $redemption))
            ->assertRedirect();

        $redemption->refresh();

        $this->assertSame('completed', $redemption->status);
    }
}
