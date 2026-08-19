<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Redirect admin users to admin product monitoring page
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.products')->with('info', 'Akses katalog publik dibatasi untuk akun admin. Gunakan panel admin untuk monitoring.');
        }
        $query = Product::with(['category', 'user'])
            ->available();

        // Filter by category
        if ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by condition
        if ($request->has('condition') && $request->condition) {
            $query->where('condition', $request->condition);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->sort ?? 'latest';
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'carbon_high':
                $query->orderBy('carbon_saved', 'desc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::active()->get();

        return view('eco-loop.pages.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // Redirect admin users away from public product details
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.products')->with('info', 'Akses produk publik dibatasi untuk akun admin.');
        }
        $product->load(['category', 'user']);

        if ($product->status !== 'available' || $product->stock <= 0) {
            abort(404);
        }

        // Related products
        $relatedProducts = Product::with(['category', 'user'])
            ->available()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('eco-loop.pages.products.show', compact('product', 'relatedProducts'));
    }

    public function create()
    {
        $categories = Category::active()->get();

        return view('eco-loop.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'city' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:1',
            'condition' => 'required|in:like_new,good,fair,new',
            'image' => 'nullable|image|max:2048',
        ]);

        $category = Category::find($validated['category_id']);
        $carbonSaved = $validated['weight'] * $category->carbon_value_per_kg;

        $product = Product::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'city' => $validated['city'],
            'price' => $validated['price'],
            'weight' => $validated['weight'],
            'stock' => $validated['stock'],
            'condition' => $validated['condition'],
            'carbon_saved' => $carbonSaved,
        ]);

        if ($request->hasFile('image')) {
            // Handle image upload
            $path = $request->file('image')->store('products', 'public');
            $product->update(['image' => $path]);
        }

        return redirect()->route('products.show', $product)
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::active()->get();
        return view('eco-loop.pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:5000',
            'city' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'condition' => 'required|in:like_new,good,fair,new',
            'image' => 'nullable|image|max:2048',
        ]);

        $category = Category::find($validated['category_id']);
        $carbonSaved = $validated['weight'] * ($category->carbon_value_per_kg ?? 1.0);

        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
            'city' => $validated['city'],
            'price' => $validated['price'],
            'weight' => $validated['weight'],
            'stock' => $validated['stock'],
            'condition' => $validated['condition'],
            'carbon_saved' => $carbonSaved,
            'is_active' => false,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->update(['image' => $path]);
        }

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('dashboard.products')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
