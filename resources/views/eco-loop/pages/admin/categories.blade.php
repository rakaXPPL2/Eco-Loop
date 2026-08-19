<x-eco-loop-layout title="Kelola Kategori - Admin">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <x-admin-sidebar :stats="[
            'pending_stores' => 0,
            'pending_complaints' => 0
        ]" />

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Admin Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4 animate-fade-in-up">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center shadow-lg shadow-teal-200">
                                <i class="fas fa-tags text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Kelola Kategori</h1>
                                <p class="text-emerald-600">Kelola kategori produk di platform</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 animate-fade-in-up hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-tag mr-2"></i>{{ $categories->count() }} Kategori
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Categories List -->
                <div class="space-y-6 stagger-children">
                    @forelse($categories as $category)
                        <div class="glass-card-light p-6 animate-fade-in-up">
                            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-start gap-6">
                                    <!-- Icon Preview -->
                                    <div class="hidden md:flex">
                                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-teal-100 to-cyan-100 flex items-center justify-center">
                                            <i class="fas {{ $category->icon ?? 'fa-tag' }} text-3xl text-teal-600"></i>
                                        </div>
                                    </div>

                                    <!-- Form Fields -->
                                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
                                            <input type="text" name="name" value="{{ $category->name }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Icon (FontAwesome)</label>
                                            <input type="text" name="icon" value="{{ $category->icon }}" placeholder="fa-box" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nilai Karbon (kg CO2)</label>
                                            <input type="number" name="carbon_value_per_kg" value="{{ $category->carbon_value_per_kg }}" step="0.0001" min="0" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                            <select name="is_active" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                                                <option value="1" {{ $category->is_active ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ !$category->is_active ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                                            <textarea name="description" rows="2" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">{{ $category->description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-2 text-gray-500 text-sm">
                                        <i class="fas fa-box"></i>
                                        <span>{{ $category->products_count }} produk</span>
                                    </div>
                                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold rounded-xl hover:from-teal-600 hover:to-cyan-600 transition-all shadow-lg shadow-teal-200 hover:shadow-teal-300">
                                        <i class="fas fa-save mr-2"></i>Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    @empty
                        <div class="glass-card-light p-12 text-center">
                            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-teal-50 flex items-center justify-center">
                                <i class="fas fa-tags text-4xl text-teal-400"></i>
                            </div>
                            <p class="text-gray-500">Belum ada kategori</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
