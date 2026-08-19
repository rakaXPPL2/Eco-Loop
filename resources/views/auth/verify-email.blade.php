<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 py-12 px-4">
        <div class="max-w-md w-full">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-200">
                    <i class="fas fa-envelope text-white text-3xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Verifikasi Email</h1>
                <p class="text-gray-600">Eco-Loop</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="mb-6">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                        <i class="fas fa-check-circle text-emerald-500 text-2xl"></i>
                    </div>
                    <p class="text-gray-600 text-center">
                        Terima kasih telah mendaftar! Sebelum melanjutkan, silakan verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirim ke email Anda.
                    </p>
                    <p class="text-gray-600 text-center mt-3">
                        Jika Anda tidak menerima email, kami dengan senang hati akan mengirim ulang.
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-emerald-500"></i>
                            <p class="text-emerald-700 font-medium">
                                Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                            </p>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col gap-3">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full btn-eco flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full btn-eco-outline flex items-center justify-center gap-2">
                            <i class="fas fa-sign-out-alt"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-center text-gray-500 text-sm mt-6">
                Kembali ke <a href="{{ route('home') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">Beranda</a>
            </p>
        </div>
    </div>
</x-guest-layout>
