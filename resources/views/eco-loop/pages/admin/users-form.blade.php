<x-eco-loop-layout title="Form Pengguna - Admin">
    <div class="max-w-4xl mx-auto py-8">
        <div class="glass-card-light p-6">
            <h2 class="text-xl font-bold mb-4">{{ isset($user) ? 'Edit Pengguna' : 'Buat Pengguna Baru' }}</h2>

            <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="input-eco w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="input-eco w-full">
                    </div>
                    @if(!isset($user))
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Password (biarkan kosong untuk default 'password')</label>
                        <input type="password" name="password" class="input-eco w-full">
                    </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role" class="input-eco w-full">
                            @php $r = old('role', $user->role ?? 'user'); @endphp
                            <option value="user" {{ $r === 'user' ? 'selected' : '' }}>User</option>
                            <option value="buyer" {{ $r === 'buyer' ? 'selected' : '' }}>Buyer</option>
                            <option value="seller" {{ $r === 'seller' ? 'selected' : '' }}>Seller</option>
                            <option value="admin" {{ $r === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Region</label>
                        <select name="region_id" class="input-eco w-full">
                            <option value="">-- Pilih Region --</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ (old('region_id', $user->region_id ?? '') == $region->id) ? 'selected' : '' }}>{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="input-eco w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="address" class="input-eco w-full">{{ old('address', $user->address ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="btn-eco">Simpan</button>
                    <a href="{{ route('admin.users') }}" class="btn-eco-outline">Batal</a>
                </div>
            </form>

            @if(isset($user))
                <hr class="my-6">
                <h3 class="text-lg font-semibold mb-2">Ubah Password</h3>
                <form action="{{ route('admin.users.password', $user) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="password" required class="input-eco w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ulangi Password</label>
                            <input type="password" name="password_confirmation" required class="input-eco w-full">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn-eco">Perbarui Password</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-eco-loop-layout>
