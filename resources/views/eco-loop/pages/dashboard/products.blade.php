<x-eco-loop-layout title="Produk Saya">
    @php
        $availableCount = $products->where('status', 'available')->count();
        $soldCount = $products->where('status', 'sold')->count();
        $reservedCount = $products->where('status', 'reserved')->count();
        $totalEarnings = $products->where('status', 'sold')->sum('price');
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
            <!-- Header -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                            <i class="fas fa-boxes text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Produk Saya</h1>
                            <p class="text-gray-500 flex items-center gap-2">
                                <i class="fas fa-leaf text-emerald-500"></i>
                                Kelola produk hijau Anda untuk bumi
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-1">
                        <i class="fas fa-plus"></i>
                        Tambah Produk
                    </a>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 stagger-children">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-fade-in-up group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-boxes text-white text-lg"></i>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $products->total() }}</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-fade-in-up delay-100 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-check-circle text-white text-lg"></i>
                        </div>
                        <span class="w-2 h-2 bg-teal-500 rounded-full animate-pulse"></span>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Tersedia</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $availableCount ?? 0 }}</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-fade-in-up delay-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fas fa-sold text-white text-lg"></i>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Terjual</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $soldCount ?? 0 }}</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-fade-in-up delay-300 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-wallet text-white text-lg"></i>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Total Penjualan</p>
                    <p class="text-xl lg:text-2xl font-bold text-gray-800">Rp {{ number_format($totalEarnings ?? 0, 0) }}</p>
                </div>
            </div>

            <!-- Products List -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up delay-200">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg">
                                <i class="fas fa-list text-white"></i>
                            </div>
                            Semua Produk
                        </h2>
                        <span class="text-gray-500 text-sm">{{ $products->total() }} produk</span>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($products as $product)
                        <div class="p-5 hover:bg-gray-50 transition-all cursor-pointer group">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                                <div class="flex items-start space-x-4">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 rounded-xl object-cover border-2 border-gray-200 group-hover:border-emerald-300 transition-all shadow-md">
                                    @else
                                        <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-xl flex items-center justify-center border-2 border-gray-200 group-hover:border-emerald-300 transition-all">
                                            <i class="fas fa-image text-2xl text-emerald-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-lg group-hover:text-emerald-600 transition-colors">{{ $product->name }}</h3>
                                        <p class="text-gray-500 text-sm mt-1 max-w-md">{{ Str::limit($product->description, 80) }}</p>
                                        <div class="flex items-center flex-wrap gap-4 mt-3">
                                            <span class="text-lg font-bold text-emerald-600">Rp {{ number_format($product->price, 0) }}</span>
                                            @if($product->carbon_saved)
                                                <span class="inline-flex items-center gap-1 text-sm text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full border border-emerald-200">
                                                    <i class="fas fa-leaf"></i>
                                                    {{ $product->carbon_saved }} kg CO2
                                                </span>
                                            @endif
                                            <span class="text-sm text-gray-500">
                                                <i class="fas fa-box mr-1"></i>Stok: {{ $product->stock ?? 1 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between lg:justify-end gap-4 lg:gap-6">
                                    <!-- Status Badge -->
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold
                                        @if($product->status === 'available')
                                            bg-emerald-100 text-emerald-700 border border-emerald-200
                                        @elseif($product->status === 'sold')
                                            bg-gray-100 text-gray-600 border border-gray-200
                                        @elseif($product->status === 'reserved')
                                            bg-amber-100 text-amber-700 border border-amber-200
                                        @else
                                            bg-gray-100 text-gray-500 border border-gray-200
                                        @endif">
                                        <span class="w-2 h-2 rounded-full
                                            @if($product->status === 'available')
                                                bg-emerald-500 animate-pulse
                                            @elseif($product->status === 'sold')
                                                bg-gray-500
                                            @elseif($product->status === 'reserved')
                                                bg-amber-500 animate-pulse
                                            @else
                                                bg-gray-500
                                            @endif"></span>
                                        {{ ucfirst($product->status) }}
                                    </span>

                                    <!-- Actions -->
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('products.edit', $product) }}" class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 border border-blue-200 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all shadow-sm hover:shadow-md" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 rounded-xl bg-red-100 text-red-600 border border-red-200 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all shadow-sm hover:shadow-md" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-16 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center border-2 border-emerald-200">
                                <i class="fas fa-box-open text-4xl text-emerald-400"></i>
                            </div>
                            <p class="text-gray-500 text-lg mb-4">Belum ada produk</p>
                            <p class="text-gray-400 text-sm mb-6">Mulai jual produk eco-friendly Anda sekarang!</p>
                            <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-1">
                                <i class="fas fa-plus"></i>
                                Tambah Produk Pertama
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="p-6 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <p class="text-gray-500 text-sm">
                                Menampilkan {{ $products->firstItem() ?? 0 }} hingga {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
                            </p>
                            <div class="flex items-center gap-2">
                                @if($products->onFirstPage())
                                    <span class="px-4 py-2 text-sm text-gray-400 cursor-not-allowed rounded-xl bg-gray-100 border border-gray-200">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-xl font-semibold transition-all border border-emerald-200 hover:border-emerald-300">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </a>
                                @endif

                                <span class="px-4 py-2 text-sm bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-xl font-bold shadow-md">{{ $products->currentPage() }}</span>

                                @if($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-xl font-semibold transition-all border border-emerald-200 hover:border-emerald-300">
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                @else
                                    <span class="px-4 py-2 text-sm text-gray-400 cursor-not-allowed rounded-xl bg-gray-100 border border-gray-200">
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-eco-loop-layout>
