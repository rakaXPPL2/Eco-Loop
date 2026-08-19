<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();

        return view('eco-loop.pages.cart', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        if ($product->status !== 'available' || $product->stock <= 0) {
            return back()->with('error', 'Produk tidak tersedia');
        }

        $cart = $this->getOrCreateCart();

        // Check if product already in cart
        $existingItem = $cart->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            if ($existingItem->quantity < $product->stock) {
                $existingItem->increment('quantity');
                $existingItem->recalculateCarbon();
            }
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'carbon_saved' => $product->carbon_saved,
            ]);
        }

        $cart->recalculateTotal();

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, CartItem $item)
    {
        // Authorization check: verify cart belongs to authenticated user
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $item->product->stock,
        ]);

        $item->update(['quantity' => $validated['quantity']]);
        $item->recalculateCarbon();
        $item->cart->recalculateTotal();

        return back()->with('success', 'Jumlah diperbarui');
    }

    public function remove(CartItem $item)
    {
        // Authorization check: verify cart belongs to authenticated user
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $item->delete();
        $item->cart->recalculateTotal();

        return back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function clear()
    {
        $cart = $this->getOrCreateCart();
        $cart->items()->delete();
        $cart->update(['total_carbon_saved' => 0]);

        return back()->with('success', 'Keranjang dikosongkan');
    }

    private function getOrCreateCart(): Cart
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => auth()->id()],
            ['total_carbon_saved' => 0]
        );

        return $cart->load('items.product.category');
    }
}
