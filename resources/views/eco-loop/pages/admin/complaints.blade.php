<x-eco-loop-layout title="Pengaduan - Admin">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <x-admin-sidebar :stats="[
            'pending_stores' => 0,
            'pending_complaints' => 0
        ]" />

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-200">
                            <i class="fas fa-exclamation-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Pengaduan & Komplain</h1>
                            <p class="text-emerald-600">Tangani pengaduan dari pengguna</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid lg:grid-cols-3 gap-6">
                    <!-- Complaint List -->
                    <div class="lg:col-span-2 glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 100ms;">
                        <!-- Filter Tabs -->
                        <div class="p-4 border-b border-gray-100 bg-gray-50">
                            <div class="flex flex-wrap gap-2">
                                <a href="?status=all" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ !request('status') || request('status') == 'all' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'text-gray-600 hover:bg-gray-100' }}">
                                    <i class="fas fa-list mr-1"></i> Semua
                                </a>
                                <a href="?status=pending" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') == 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'text-gray-600 hover:bg-gray-100' }}">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                    @if($complaints->where('status', 'pending')->count() > 0)
                                        <span class="ml-1 px-2 py-0.5 bg-red-500 text-white text-xs rounded-full">{{ $complaints->where('status', 'pending')->count() }}</span>
                                    @endif
                                </a>
                                <a href="?status=reviewing" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') == 'reviewing' ? 'bg-blue-500 text-white shadow-lg shadow-blue-200' : 'text-gray-600 hover:bg-gray-100' }}">
                                    <i class="fas fa-search mr-1"></i> Ditinjau
                                </a>
                                <a href="?status=resolved" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') == 'resolved' ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-200' : 'text-gray-600 hover:bg-gray-100' }}">
                                    <i class="fas fa-check mr-1"></i> Selesai
                                </a>
                            </div>
                        </div>

                        <!-- Complaint List -->
                        <div class="divide-y divide-gray-100 max-h-[600px] overflow-y-auto custom-scrollbar">
                            @forelse($complaints as $complaint)
                                <a href="?id={{ $complaint->id }}{{ request('status') ? '&status='.request('status') : '' }}" class="block p-4 hover:bg-emerald-50 transition-colors {{ request('id') == $complaint->id ? 'bg-amber-50 border-l-4 border-amber-400' : '' }}">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                                            @if($complaint->status === 'pending') bg-amber-100
                                            @elseif($complaint->status === 'reviewing') bg-blue-100
                                            @elseif($complaint->status === 'resolved') bg-emerald-100
                                            @else bg-red-100 @endif">
                                            <i class="fas fa-exclamation text-lg
                                                @if($complaint->status === 'pending') text-amber-600
                                                @elseif($complaint->status === 'reviewing') text-blue-600
                                                @elseif($complaint->status === 'resolved') text-emerald-600
                                                @else text-red-600 @endif"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-gray-800 truncate">{{ $complaint->subject }}</span>
                                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                                    @if($complaint->status === 'pending') bg-amber-100 text-amber-700
                                                    @elseif($complaint->status === 'reviewing') bg-blue-100 text-blue-700
                                                    @elseif($complaint->status === 'resolved') bg-emerald-100 text-emerald-700
                                                    @else bg-red-100 text-red-700 @endif">
                                                    {{ ucfirst($complaint->status) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-500 line-clamp-1">{{ Str::limit($complaint->description, 80) }}</p>
                                            <div class="flex items-center gap-4 mt-2 text-xs text-gray-400">
                                                <span><i class="fas fa-user mr-1"></i>{{ $complaint->user->name }}</span>
                                                <span><i class="fas fa-clock mr-1"></i>{{ $complaint->created_at->diffForHumans() }}</span>
                                                @if($complaint->order)
                                                    <span><i class="fas fa-receipt mr-1"></i>#{{ $complaint->order->order_number }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-12 text-center">
                                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                                        <i class="fas fa-check-circle text-4xl text-emerald-500"></i>
                                    </div>
                                    <p class="text-gray-500">Tidak ada pengaduan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Complaint Detail Panel -->
                    <div class="glass-card-light overflow-hidden animate-fade-in-up h-fit" style="animation-delay: 200ms;">
                        @if($selectedComplaint = \App\Models\Complaint::with('user', 'order')->find(request('id')))
                            <!-- Header -->
                            <div class="p-4 border-b border-gray-100 bg-gray-50">
                                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-file-alt text-amber-500"></i>
                                    Detail Pengaduan
                                </h3>
                                <p class="text-gray-500 text-sm mt-1">{{ $selectedComplaint->user->name }} - {{ $selectedComplaint->created_at->format('d M Y, H:i') }}</p>
                            </div>

                            <!-- Content -->
                            <div class="p-4 space-y-4">
                                <!-- Subject -->
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800">{{ $selectedComplaint->subject }}</h4>
                                </div>

                                <!-- Description -->
                                <div class="p-4 bg-gray-50 rounded-xl">
                                    <p class="text-gray-700">{{ $selectedComplaint->description }}</p>
                                </div>

                                <!-- Related Order -->
                                @if($selectedComplaint->order)
                                    <div class="p-4 bg-blue-50 rounded-xl border border-blue-200">
                                        <p class="text-xs text-blue-700 font-semibold mb-1"><i class="fas fa-receipt mr-1"></i>Order Terkait</p>
                                        <p class="font-bold text-gray-800">{{ $selectedComplaint->order->order_number }}</p>
                                        <p class="text-gray-600 text-sm">Rp {{ number_format($selectedComplaint->order->total_amount, 0, ',', '.') }}</p>
                                    </div>
                                @endif

                                <!-- Admin Response -->
                                @if($selectedComplaint->response)
                                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-200">
                                        <p class="text-xs text-emerald-700 font-semibold mb-2"><i class="fas fa-check-circle mr-1"></i>Tanggapan Admin</p>
                                        <p class="text-gray-700">{{ $selectedComplaint->response }}</p>
                                        @if($selectedComplaint->resolved_at)
                                            <p class="text-xs text-gray-400 mt-2">{{ $selectedComplaint->resolved_at->format('d M Y, H:i') }}</p>
                                        @endif
                                    </div>
                                @endif

                                <!-- Response Form -->
                                @if($selectedComplaint->status !== 'resolved')
                                    <form action="{{ route('admin.complaints.update', $selectedComplaint) }}" method="POST" class="space-y-4 pt-4 border-t border-gray-100">
                                        @csrf
                                        @method('PATCH')

                                        <!-- Status -->
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                            <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all">
                                                <option value="pending" {{ $selectedComplaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="reviewing" {{ $selectedComplaint->status == 'reviewing' ? 'selected' : '' }}>Ditinjau</option>
                                                <option value="resolved" {{ $selectedComplaint->status == 'resolved' ? 'selected' : '' }}>Selesai</option>
                                                <option value="rejected" {{ $selectedComplaint->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>

                                        <!-- Response -->
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggapan <span class="text-red-500">*</span></label>
                                            <textarea name="response" rows="4" required
                                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all"
                                                placeholder="Tulis tanggapan Anda...">{{ $selectedComplaint->response }}</textarea>
                                        </div>

                                        <!-- Submit -->
                                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg shadow-amber-200 hover:shadow-amber-300">
                                            <i class="fas fa-save mr-2"></i>Simpan Tanggapan
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="p-12 text-center">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-emerald-50 flex items-center justify-center">
                                    <i class="fas fa-hand-pointer text-4xl text-emerald-400"></i>
                                </div>
                                <p class="text-gray-500">Pilih pengaduan untuk ditangani</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
