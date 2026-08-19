<x-eco-loop-layout title="Edit Produk - Eco-Loop">

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('dashboard.products') }}" class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition-colors">
                        <i class="fas fa-arrow-left text-white text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-white">Edit Produk</h1>
                        <p class="text-white/80">Perbarui informasi produk Anda</p>
                    </div>
                </div>
                <span class="px-4 py-2 bg-white/20 rounded-full text-white text-sm font-semibold">
                    <i class="fas fa-edit mr-2"></i>Mode Edit
                </span>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <section class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Main Card -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-box text-emerald-500"></i>
                        Informasi Produk
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Product Name -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Produk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                                   class="input-eco @error('name') border-red-500 @enderror"
                                   placeholder="Contoh: Kulit Sapi Olahan Premium">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" id="category_id" required
                                    class="input-eco @error('category_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            data-carbon="{{ $category->carbon_value_per_kg }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->carbon_value_per_kg }} kg CO2/kg)
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                                Harga (Rp) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex">
                                <span class="inline-flex items-center px-4 rounded-l-xl border-2 border-r-0 border-gray-300 bg-gray-50 text-gray-500 font-medium">
                                    Rp
                                </span>
                                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0" step="100"
                                       class="input-eco rounded-l-none @error('price') border-red-500 @enderror"
                                       placeholder="0">
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Weight -->
                        <div>
                            <label for="weight" class="block text-sm font-semibold text-gray-700 mb-2">
                                Berat (kg) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex">
                                <input type="number" name="weight" id="weight" value="{{ old('weight', $product->weight) }}" required min="0.1" step="0.1"
                                       class="input-eco rounded-r-none @error('weight') border-red-500 @enderror"
                                       placeholder="0.0"
                                       oninput="calculateCarbon()">
                                <span class="inline-flex items-center px-4 rounded-r-xl border-2 border-l-0 border-gray-300 bg-gray-50 text-gray-500 font-medium">
                                    kg
                                </span>
                            </div>
                            @error('weight')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required min="1"
                                   class="input-eco @error('stock') border-red-500 @enderror"
                                   placeholder="1">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kota <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="city" id="city" value="{{ old('city', $product->city) }}" required
                                   class="input-eco @error('city') border-red-500 @enderror"
                                   placeholder="Contoh: Yogyakarta">
                            @error('city')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Carbon Calculation Display -->
                        <div class="md:col-span-2">
                            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center">
                                            <i class="fas fa-leaf text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Karbon yang dihemat</p>
                                            <p class="text-2xl font-bold text-emerald-600" id="carbon-display">{{ $product->carbon_saved }} kg CO2</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Poin Voucher</p>
                                        <p class="text-lg font-semibold text-emerald-600" id="points-display">{{ round($product->carbon_saved * 10) }} poin</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" id="description" rows="4" required
                                      class="input-eco @error('description') border-red-500 @enderror"
                                      placeholder="Jelaskan detail produk: asal barang, kondisi, penggunaan, dll">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Image Upload Card -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-image text-emerald-500"></i>
                        Foto Produk
                    </h2>

                    @if($product->image)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-32 h-32 rounded-xl object-cover border-2 border-gray-200">
                        </div>
                    @endif

                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-emerald-500 transition-colors cursor-pointer"
                         onclick="document.getElementById('image').click()">
                        <div class="mb-4">
                            <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-cloud-upload-alt text-3xl text-emerald-500"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-2">
                            <span class="text-emerald-500 font-semibold cursor-pointer">Pilih file</span>
                            atau drag & drop
                        </p>
                        <p class="text-sm text-gray-500">PNG, JPG, atau WEBP (Maks. 2MB)</p>
                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                               onchange="handleFileSelect(event)">
                        <div id="preview-container" class="mt-4 hidden">
                            <img id="preview-image" src="" alt="Preview" class="max-h-48 mx-auto rounded-lg shadow-md">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 text-center">Kosongkan jika tidak ingin mengubah foto</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('dashboard.products') }}" class="btn-eco-secondary px-6 py-3">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <div class="flex gap-4">
                        <button type="submit" class="btn-eco px-8 py-3">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @push('scripts')
    <script>
        // DEBUG: Intercept form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submit intercepted!');
            console.log('Form action:', this.action);
            console.log('Form method:', this.method);
            console.log('Form data:', new FormData(this));
            alert('DEBUG: Form submit intercepted!\nAction: ' + this.action + '\nMethod: ' + this.method + '\n\nKlik OK untuk submit manual.');
            this.submit();
        });

        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function calculateCarbon() {
            const weight = parseFloat(document.getElementById('weight').value) || 0;
            const categorySelect = document.getElementById('category_id');
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const carbonPerKg = parseFloat(selectedOption?.dataset?.carbon) || 0;

            if (weight > 0 && carbonPerKg > 0) {
                const carbonSaved = weight * carbonPerKg;
                const points = Math.round(carbonSaved * 10);

                document.getElementById('carbon-display').textContent = carbonSaved.toFixed(2) + ' kg CO2';
                document.getElementById('points-display').textContent = '+' + points + ' poin';
            }
        }
    </script>
    @endpush

</x-eco-loop-layout>
