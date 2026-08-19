<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('store.create');
        }

        return view('eco-loop.pages.store.index', compact('store'));
    }

    public function create()
    {
        // Check if user is seller
        if (!auth()->user()->isSeller()) {
            abort(403, 'Hanya penjual yang dapat membuat toko.');
        }

        // Check if store already exists
        if (auth()->user()->store) {
            return redirect()->route('store.edit');
        }

        $regions = Region::orderBy('name')->get();

        return view('eco-loop.pages.store.create', compact('regions'));
    }

    public function store(Request $request)
    {
        // Check if user is seller
        if (!auth()->user()->isSeller()) {
            abort(403, 'Hanya penjual yang dapat membuat toko.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'address' => 'required|string|max:500',
            'region_id' => 'required|exists:regions,id',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:4096',
        ]);

        $photoPath = null;
        $bannerPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('stores/photos', 'public');
        }

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('stores/banners', 'public');
        }

        $store = Store::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'],
            'region_id' => $validated['region_id'],
            'phone' => $validated['phone'] ?? null,
            'photo' => $photoPath,
            'banner' => $bannerPath,
        ]);

        // Update user's store_completed flag
        auth()->user()->update(['store_completed' => true]);

        return redirect()->route('store.index')
            ->with('success', 'Toko Anda berhasil dibuat!');
    }

    public function edit()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('store.create');
        }

        $regions = Region::orderBy('name')->get();

        return view('eco-loop.pages.store.edit', compact('store', 'regions'));
    }

    public function update(Request $request, Store $store)
    {
        // Only owner can update
        if ($store->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'address' => 'required|string|max:500',
            'region_id' => 'required|exists:regions,id',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:4096',
        ]);

        $photoPath = $store->photo;
        $bannerPath = $store->banner;

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($store->photo) {
                Storage::disk('public')->delete($store->photo);
            }
            $photoPath = $request->file('photo')->store('stores/photos', 'public');
        }

        if ($request->hasFile('banner')) {
            // Delete old banner
            if ($store->banner) {
                Storage::disk('public')->delete($store->banner);
            }
            $bannerPath = $request->file('banner')->store('stores/banners', 'public');
        }

        $store->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'],
            'region_id' => $validated['region_id'],
            'phone' => $validated['phone'] ?? null,
            'photo' => $photoPath,
            'banner' => $bannerPath,
        ]);

        return redirect()->back()
            ->with('success', 'Toko berhasil diperbarui!');
    }

    public function show(Store $store)
    {
        $store->load(['user.products' => function ($query) {
            $query->available()->limit(8);
        }, 'region']);

        return view('eco-loop.pages.store.show', compact('store'));
    }
}
