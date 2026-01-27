<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div class="mb-4 px-4 py-3 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Approval Peminjaman Ruangan</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola persetujuan peminjaman ruangan yang masuk</p>
                </div>

                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50">
                    <input wire:model.live="search" type="text" placeholder="Cari booking number, nama peminjam, ruangan..." class="w-full px-4 py-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm placeholder-gray-400">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                        <thead class="bg-gray-50/50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Booking</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Ruangan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Tujuan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($pendingBookings as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->booking_number }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $booking->borrower_name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->nim_nip }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->phone }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $booking->room->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->room->code }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700 dark:text-gray-300">{{ $booking->start_datetime->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->start_datetime->format('H:i') }} - {{ $booking->end_datetime->format('H:i') }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Durasi: {{ $booking->start_datetime->diffInDays($booking->end_datetime) }} hari</div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="text-sm text-gray-700 dark:text-gray-300 truncate" title="{{ $booking->purpose }}">{{ $booking->purpose }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <button wire:click="confirmApprove({{ $booking->id }})" class="inline-flex items-center px-3 py-1.5 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 hover:bg-emerald-200 dark:hover:bg-emerald-900/50 rounded-lg text-sm font-medium transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Setujui
                                        </button>
                                        <button wire:click="confirmReject({{ $booking->id }})" class="inline-flex items-center px-3 py-1.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50 rounded-lg text-sm font-medium transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400">Tidak ada peminjaman yang menunggu approval.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pendingBookings->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $pendingBookings->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Approval Modal -->
    @if($showApprovalModal && $selectedBorrowing)
    <div class="fixed inset-0 z-50 overflow-y-auto" style="display: block;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" wire:click="closeModals"></div>
            
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-lg w-full p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Konfirmasi Persetujuan</h3>
                
                <div class="mb-4 space-y-2 text-sm">
                    <p class="text-gray-700 dark:text-gray-300"><strong>Booking:</strong> {{ $selectedBorrowing->booking_number }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Peminjam:</strong> {{ $selectedBorrowing->borrower_name }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Ruangan:</strong> {{ $selectedBorrowing->room->name }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Waktu:</strong> {{ $selectedBorrowing->start_datetime->format('d M Y, H:i') }} - {{ $selectedBorrowing->end_datetime->format('d M Y, H:i') }}</p>
                </div>

                <p class="text-gray-600 dark:text-gray-400 mb-6">Apakah Anda yakin ingin menyetujui peminjaman ruangan ini?</p>

                <div class="flex justify-end space-x-3">
                    <button wire:click="closeModals" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Batal</button>
                    <button wire:click="approve" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">Setujui</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Rejection Modal -->
    @if($showRejectionModal && $selectedBorrowing)
    <div class="fixed inset-0 z-50 overflow-y-auto" style="display: block;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" wire:click="closeModals"></div>
            
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-lg w-full p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Tolak Peminjaman</h3>
                
                <div class="mb-4 space-y-2 text-sm">
                    <p class="text-gray-700 dark:text-gray-300"><strong>Booking:</strong> {{ $selectedBorrowing->booking_number }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Peminjam:</strong> {{ $selectedBorrowing->borrower_name }}</p>
                    <p class="text-gray-700 dark:text-gray-300"><strong>Ruangan:</strong> {{ $selectedBorrowing->room->name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <textarea wire:model="rejectionReason" rows="4" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-red-500 focus:ring-red-500" placeholder="Jelaskan alasan penolakan (minimal 10 karakter)"></textarea>
                    @error('rejectionReason') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button wire:click="closeModals" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Batal</button>
                    <button wire:click="reject" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Tolak Peminjaman</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
