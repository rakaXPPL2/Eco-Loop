<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Order;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // User creates a complaint
    public function create(Order $order = null)
    {
        return view('eco-loop.pages.complaints.create', compact('order'));
    }

    public function store(Request $request, Order $order = null)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        $complaint = Complaint::create([
            'user_id' => auth()->id(),
            'order_id' => $validated['order_id'] ?? $order?->id,
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        return redirect()->route('complaints.show', $complaint)
            ->with('success', 'Pengaduan berhasil dikirim. Tim kami akan meninjau segera.');
    }

    public function show(Complaint $complaint)
    {
        // Only owner or admin can view
        if ($complaint->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('eco-loop.pages.complaints.show', compact('complaint'));
    }

    public function userIndex()
    {
        $complaints = Complaint::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('eco-loop.pages.complaints.index', compact('complaints'));
    }

    // Admin functions
    public function adminIndex()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $complaints = Complaint::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('eco-loop.pages.admin.complaints.index', compact('complaints'));
    }

    public function adminUpdate(Request $request, Complaint $complaint)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,resolved,rejected',
            'response' => 'required|string|max:2000',
        ]);

        $complaint->update([
            'status' => $validated['status'],
            'response' => $validated['response'],
            'resolved_at' => in_array($validated['status'], ['resolved', 'rejected']) ? now() : null,
        ]);

        return redirect()->back()
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
