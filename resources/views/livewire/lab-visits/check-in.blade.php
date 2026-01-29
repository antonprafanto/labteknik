<div class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-900 py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-teal-500 to-indigo-600 rounded-2xl shadow-2xl mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Check-In Kunjungan Lab</h1>
            <p class="text-gray-300">Selamat datang! Silakan isi data kunjungan Anda.</p>
            @if($laboratory)
                <div class="mt-4 inline-flex items-center px-4 py-2 bg-teal-500/20 border border-teal-500/50 rounded-full">
                    <svg class="w-5 h-5 text-teal-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span class="text-teal-300 font-semibold">{{ $laboratory->name }}</span>
                </div>
            @endif
        </div>

        @if($showSuccess)
            <!-- Success State -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 text-center">
                <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Check-In Berhasil!</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Terima kasih sudah berkunjung. Jangan lupa check-out saat pulang!</p>
                
                <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4 mb-6">
                    <p class="text-amber-800 dark:text-amber-300 text-sm">
                        <strong>Catatan:</strong> Simpan NIM/NIP Anda untuk proses check-out nanti.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('lab-visits.check-out') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Check-Out
                    </a>
                    <button wire:click="resetForm" class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-xl transition-colors">
                        Check-In Lagi
                    </button>
                </div>
            </div>
        @else
            <!-- Check-In Form -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-teal-500 to-indigo-600"></div>
                
                <form wire:submit.prevent="checkIn" class="p-8 space-y-6">
                    @if(!$laboratory)
                    <!-- Laboratory Selection -->
                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                            Laboratorium <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="laboratoryId" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Laboratorium --</option>
                            @foreach($laboratories as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                            @endforeach
                        </select>
                        @error('laboratoryId') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    <!-- Visitor Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="visitor_name" type="text" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" placeholder="Nama lengkap">
                            @error('visitor_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                                NIM/NIP <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="nim_nip" type="text" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" placeholder="NIM atau NIP">
                            @error('nim_nip') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">Email</label>
                            <input wire:model="email" type="email" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" placeholder="email@example.com">
                            @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">No. Telepon</label>
                            <input wire:model="phone" type="text" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" placeholder="08xxxxxxxxxx">
                            @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">Program Studi</label>
                            <input wire:model="study_program" type="text" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" placeholder="Contoh: Teknik Informatika">
                            @error('study_program') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                                Tipe Pengunjung <span class="text-red-500">*</span>
                            </label>
                            <select wire:model="visitor_type" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="staff">Staff</option>
                                <option value="tamu">Tamu</option>
                            </select>
                            @error('visitor_type') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Purpose & Activity -->
                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                            Tujuan Kunjungan <span class="text-red-500">*</span>
                        </label>
                        <textarea wire:model="purpose" rows="3" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" placeholder="Jelaskan tujuan kunjungan Anda..."></textarea>
                        @error('purpose') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">Aktivitas</label>
                        <select wire:model="activity" class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Aktivitas --</option>
                            <option value="praktikum">Praktikum</option>
                            <option value="penelitian">Penelitian</option>
                            <option value="belajar_mandiri">Belajar Mandiri</option>
                            <option value="tugas_akhir">Tugas Akhir / Skripsi</option>
                            <option value="kunjungan">Kunjungan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        @error('activity') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-teal-600 to-indigo-600 hover:from-teal-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center">
                        <svg wire:loading.remove wire:target="checkIn" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <svg wire:loading wire:target="checkIn" class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="checkIn">Check-In Sekarang</span>
                        <span wire:loading wire:target="checkIn">Memproses...</span>
                    </button>
                </form>
            </div>
        @endif

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-400 text-sm">Lab Teknik Unmul © {{ date('Y') }}</p>
        </div>
    </div>
</div>
