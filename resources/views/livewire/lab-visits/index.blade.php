<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Kunjungan Lab</h1>
                <p class="text-gray-600 dark:text-gray-400">Kelola data kunjungan laboratorium</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('lab-visits.qr-codes') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h2M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    QR Codes
                </a>
                <button wire:click="exportCsv" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export CSV
                </button>
            </div>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium">Total</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($statistics['total']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium">Hari Ini</p>
                <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($statistics['today']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium">Mahasiswa</p>
                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($statistics['mahasiswa']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium">Dosen</p>
                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($statistics['dosen']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium">Staff</p>
                <p class="text-2xl font-bold text-teal-600 dark:text-teal-400">{{ number_format($statistics['staff']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium">Tamu</p>
                <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ number_format($statistics['tamu']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-amber-200 dark:border-amber-800">
                <p class="text-xs text-amber-600 dark:text-amber-400 uppercase font-medium">Belum Checkout</p>
                <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ number_format($statistics['not_checked_out']) }}</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Cari</label>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Nama, NIM, Prodi..." class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Laboratorium</label>
                    <select wire:model.live="laboratoryFilter" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white text-sm">
                        <option value="">Semua Lab</option>
                        @foreach($laboratories as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tipe</label>
                    <select wire:model.live="visitorTypeFilter" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white text-sm">
                        <option value="">Semua</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="staff">Staff</option>
                        <option value="tamu">Tamu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Dari Tanggal</label>
                    <input wire:model.live="dateFrom" type="date" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Sampai Tanggal</label>
                    <input wire:model.live="dateTo" type="date" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white text-sm">
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Pengunjung</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Lab</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Tipe</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Tujuan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Waktu</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Durasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($visits as $visit)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                    {{ $visit->check_in_time->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $visit->visitor_name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $visit->nim_nip }} {{ $visit->study_program ? '• ' . $visit->study_program : '' }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $visit->laboratory->name }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                        @if($visit->visitor_type === 'mahasiswa') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                        @elseif($visit->visitor_type === 'dosen') bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400
                                        @elseif($visit->visitor_type === 'staff') bg-teal-100 text-teal-800 dark:bg-teal-900/30 dark:text-teal-400
                                        @else bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400
                                        @endif">
                                        {{ $visit->getVisitorTypeLabel() }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400 max-w-xs truncate">{{ $visit->purpose }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                    <div>{{ $visit->check_in_time->format('H:i') }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        @if($visit->check_out_time)
                                            → {{ $visit->check_out_time->format('H:i') }}
                                        @else
                                            <span class="text-amber-600 dark:text-amber-400">aktif</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                    {{ $visit->formatted_duration }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data kunjungan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                {{ $visits->links() }}
            </div>
        </div>
    </div>
</div>
