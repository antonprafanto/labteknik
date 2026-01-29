<div class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-900 py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl shadow-2xl mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Check-Out Kunjungan Lab</h1>
            <p class="text-gray-300">Masukkan NIM/NIP untuk check-out</p>
        </div>

        @if($showSuccess && $visit)
            <!-- Success State -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 text-center">
                <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Check-Out Berhasil!</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Terima kasih telah berkunjung ke {{ $visit->laboratory->name }}.</p>
                
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-6">
                    <div class="grid grid-cols-2 gap-4 text-left">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Check-In</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $visit->check_in_time->format('H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Check-Out</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $visit->check_out_time->format('H:i') }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Durasi Kunjungan</p>
                            <p class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $visit->formatted_duration }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('lab-visits.check-in') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Check-In Baru
                    </a>
                    <button wire:click="resetForm" class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-xl transition-colors">
                        Check-Out Lagi
                    </button>
                </div>
            </div>
        @else
            <!-- Search Form -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-orange-500 to-red-600"></div>
                
                <div class="p-8">
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                            NIM/NIP <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-3">
                            <input wire:model="nim_nip" wire:keydown.enter="search" type="text" class="flex-1 px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" placeholder="Masukkan NIM/NIP Anda">
                            <button wire:click="search" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors">
                                <svg wire:loading.remove wire:target="search" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <svg wire:loading wire:target="search" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('nim_nip') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    @if(count($activeVisits) > 0)
                        <div class="space-y-3">
                            <h3 class="font-bold text-gray-900 dark:text-white">Kunjungan Aktif:</h3>
                            @foreach($activeVisits as $activeVisit)
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $activeVisit->laboratory->name }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Check-in: {{ $activeVisit->check_in_time->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <button wire:click="checkOut({{ $activeVisit->id }})" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg transition-colors">
                                        Check-Out
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Link to Check-In -->
            <div class="text-center mt-6">
                <a href="{{ route('lab-visits.check-in') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">
                    ← Belum check-in? Klik di sini
                </a>
            </div>
        @endif

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-400 text-sm">Lab Teknik Unmul © {{ date('Y') }}</p>
        </div>
    </div>
</div>
