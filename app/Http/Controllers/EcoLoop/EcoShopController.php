<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Reward;
use App\Models\Redemption;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcoShopController extends Controller
{
    public function index()
    {
        $rewards = Reward::active()->orderBy('points_required')->get();

        // Get user's points and stats
        $userPoints = auth()->user()->total_vouchers ?? 0;
        $totalCarbonSaved = auth()->user()->total_carbon_saved ?? 0;
        $vouchersRedeemed = auth()->user()->redemptions()->count() ?? 0;

        return view('eco-loop.pages.eco-shop', compact(
            'rewards',
            'userPoints',
            'totalCarbonSaved',
            'vouchersRedeemed'
        ));
    }

    public function redeem(Request $request)
    {
        $user = auth()->user();

        $rewardId = $request->input('reward_id');
        $reward = Reward::find($rewardId);

        if (!$reward) {
            return back()->with('error', 'Reward tidak ditemukan');
        }

        if (!$reward->isAvailable()) {
            return back()->with('error', 'Hadiah tidak tersedia');
        }

        if ($user->total_vouchers < $reward->points_required) {
            return back()->with('error', 'Voucher karbon tidak cukup. Anda membutuhkan ' . $reward->points_required . ' voucher.');
        }

        DB::beginTransaction();

        try {
            $user->decrement('total_vouchers', $reward->points_required);

            $redemption = Redemption::create([
                'user_id' => $user->id,
                'reward_id' => $reward->id,
                'points_spent' => $reward->points_required,
                'status' => 'pending',
                'notes' => 'Permintaan penukaran masuk ke inbox voucher menunggu diproses admin.',
            ]);

            $reward->decrementStock();

            Notification::create([
                'user_id' => $user->id,
                'type' => 'reward',
                'title' => 'Penukaran Hadiah Masuk ke Inbox',
                'message' => "Permintaan penukaran '{$reward->name}' sedang menunggu proses admin.",
                'is_read' => false,
            ]);

            DB::commit();

            return back()->with('success', 'Permintaan penukaran ' . $reward->name . ' sudah masuk ke inbox voucher. Admin akan memprosesnya terlebih dahulu.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function claim(Redemption $redemption)
    {
        if ($redemption->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke klaim ini.');
        }

        if ($redemption->status !== 'completed') {
            return back()->with('error', 'Voucher atau hadiah belum siap untuk dicairkan.');
        }

        if ($redemption->voucher_id) {
            return back()->with('success', 'Voucher sudah tersedia di inbox Anda.');
        }

        $voucher = Voucher::create([
            'user_id' => $redemption->user_id,
            'order_id' => null,
            'code' => Voucher::generateCode(),
            'carbon_amount' => 0,
            'points' => (int) ($redemption->points_spent ?? 0),
            'status' => 'active',
            'expires_at' => now()->addDays(30),
        ]);

        $redemption->update([
            'voucher_id' => $voucher->id,
        ]);

        return back()->with('success', 'Voucher berhasil dicairkan dan masuk ke inbox voucher Anda.');
    }
}
