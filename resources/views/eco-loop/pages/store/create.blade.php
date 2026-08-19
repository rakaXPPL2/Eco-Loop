<x-eco-loop-layout title="Buat Toko - Eco-Loop">
    <div class="min-h-screen bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="text-center mb-8 animate-fade-in-up">
                <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-2xl shadow-emerald-500/30">
                    <i class="fas fa-store text-white text-4xl"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                    Buka Toko <span class="text-emerald-600">Hijau</span> Anda
                </h1>
                <p class="text-gray-500 text-lg">Lengkapi informasi toko untuk mulai berjualan produk ramah lingkungan</p>
            </div>

            <!-- Progress Steps -->
            <div class="flex justify-center mb-10 animate-fade-in-up">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gradient-to-br from-emerald-400 to-emerald-600 shadow-lg shadow-emerald-500/30">
                        <i class="fas fa-store text-white"></i>
                    </div>
                    <div class="w-20 h-1 bg-emerald-200 rounded-full">
                        <div class="h-full bg-emerald-500 rounded-full w-0"></div>
                    </div>
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-emerald-100 border-2 border-emerald-300">
                        <i class="fas fa-map-marker-alt text-emerald-600"></i>
                    </div>
                    <div class="w-20 h-1 bg-emerald-200 rounded-full">
                        <div class="h-full bg-emerald-500 rounded-full w-0"></div>
                    </div>
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-emerald-100 border-2 border-emerald-300">
                        <i class="fas fa-camera text-emerald-600"></i>
                    </div>
                </div>
            </div>

            <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Store Info Card -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm animate-fade-in-up">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg">
                            <i class="fas fa-store text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Informasi Toko</h2>
                            <p class="text-gray-500 text-sm">Data dasar toko Anda</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <!-- Store Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-store text-emerald-500 mr-1"></i>
                                Nama Toko <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 transition-all focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none shadow-sm @error('name') border-red-400 @enderror"
                                placeholder="Masukkan nama toko Anda">
                            @error('name')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left text-emerald-500 mr-1"></i>
                                Deskripsi Toko
                            </label>
                            <textarea name="description" rows="4"
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 transition-all focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none shadow-sm @error('description') border-red-400 @enderror"
                                placeholder="Jelaskan tentang toko dan produk ramah lingkungan yang Anda jual...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-emerald-500 mr-1"></i>
                                No. Telepon Toko
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 transition-all focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none shadow-sm @error('phone') border-red-400 @enderror"
                                placeholder="08xxxxxxxxxx">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Location Card -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm animate-fade-in-up delay-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center shadow-lg">
                            <i class="fas fa-map-marker-alt text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Lokasi Toko</h2>
                            <p class="text-gray-500 text-sm">Wilayah dan alamat toko</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <!-- Region -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map text-emerald-500 mr-1"></i>
                                Region/Daerah <span class="text-red-500">*</span>
                            </label>
                            <select name="region_id" required
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 transition-all focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none shadow-sm @error('region_id') border-red-400 @enderror">
                                <option value="" class="text-gray-400">-- Pilih Region --</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }} - {{ $region->city }}, {{ $region->province }}
                                    </option>
                                @endforeach
                            </select>
                            @error('region_id')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-building text-emerald-500 mr-1"></i>
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea name="address" rows="3" required
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-800 transition-all focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none shadow-sm @error('address') border-red-400 @enderror"
                                placeholder="Jl. Rumah No. 1, Kelurahan, Kecamatan, Kota">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Photos Card -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm animate-fade-in-up delay-200">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center shadow-lg">
                            <i class="fas fa-camera text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Foto Toko</h2>
                            <p class="text-gray-500 text-sm">Tambahkan foto untuk menarik pembeli</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <!-- Photo -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-portrait text-emerald-500 mr-1"></i>
                                Foto Profil Toko
                            </label>
                            <div class="upload-zone rounded-xl p-8 text-center cursor-pointer border-2 border-dashed border-gray-300 hover:border-emerald-400 hover:bg-emerald-50 transition-all" id="photo-upload">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-emerald-500"></i>
                                </div>
                                <p class="text-gray-600 mb-2 font-medium">Klik atau drag file foto ke sini</p>
                                <p class="text-gray-400 text-sm">Format: JPG, PNG. Maks 2MB</p>
                                <input type="file" name="photo" accept="image/*" class="hidden" id="photo-input">
                            </div>
                            @error('photo')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Banner -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image text-emerald-500 mr-1"></i>
                                Banner Toko
                            </label>
                            <div class="upload-zone rounded-xl p-8 text-center cursor-pointer border-2 border-dashed border-gray-300 hover:border-purple-400 hover:bg-purple-50 transition-all" id="banner-upload">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-images text-3xl text-purple-500"></i>
                                </div>
                                <p class="text-gray-600 mb-2 font-medium">Klik atau drag file banner ke sini</p>
                                <p class="text-gray-400 text-sm">Format: JPG, PNG. Maks 4MB. Rekomendasi: 1200x400px</p>
                                <input type="file" name="banner" accept="image/*" class="hidden" id="banner-input">
                            </div>
                            @error('banner')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="animate-fade-in-up delay-300">
                    <button type="submit" class="w-full py-5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold text-lg rounded-2xl transition-all shadow-xl shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-1 flex items-center justify-center gap-3">
                        <i class="fas fa-store"></i>
                        Buka Toko Saya
                    </button>
                    <p class="text-center text-gray-400 text-sm mt-4">
                        Dengan membuat toko, Anda setuju dengan Syarat & Ketentuan Eco-Loop
                    </p>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Photo upload handling
        const photoUpload = document.getElementById('photo-upload');
        const photoInput = document.getElementById('photo-input');

        photoUpload.addEventListener('click', () => photoInput.click());

        photoUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            photoUpload.classList.add('dragover');
        });

        photoUpload.addEventListener('dragleave', () => {
            photoUpload.classList.remove('dragover');
        });

        photoUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            photoUpload.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                photoInput.files = e.dataTransfer.files;
            }
        });

        // Banner upload handling
        const bannerUpload = document.getElementById('banner-upload');
        const bannerInput = document.getElementById('banner-input');

        bannerUpload.addEventListener('click', () => bannerInput.click());

        bannerUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            bannerUpload.classList.add('dragover');
        });

        bannerUpload.addEventListener('dragleave', () => {
            bannerUpload.classList.remove('dragover');
        });

        bannerUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            bannerUpload.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                bannerInput.files = e.dataTransfer.files;
            }
        });

        // Show filename when selected
        photoInput.addEventListener('change', function() {
            if (this.files.length) {
                const fileName = this.files[0].name;
                photoUpload.querySelector('p').textContent = fileName;
            }
        });

        bannerInput.addEventListener('change', function() {
            if (this.files.length) {
                const fileName = this.files[0].name;
                bannerUpload.querySelector('p').textContent = fileName;
            }
        });
    </script>
    @endpush
</x-eco-loop-layout>
