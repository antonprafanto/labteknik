<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('room-borrowings.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Edit Peminjaman Ruangan</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">Perbarui detail peminjaman ruangan Anda</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <div class="mb-4 px-4 py-3 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800">
                    <p class="text-sm font-medium">Booking Number: {{ $roomBorrowing->booking_number }}</p>
                    <p class="text-xs mt-1">Anda hanya dapat mengedit peminjaman dengan status pending</p>
                </div>

                <!-- Borrower Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Informasi Peminjam
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input wire:model="borrower_name" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                            @error('borrower_name') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">NIM/NIP <span class="text-red-500">*</span></label>
                            <input wire:model="nim_nip" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                            @error('nim_nip') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">Program Studi <span class="text-red-500">*</span></label>
                            <input wire:model="study_program" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                            @error('study_program') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">No. Telepon <span class="text-red-500">*</span></label>
                            <input wire:model="phone" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                            @error('phone') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">Alamat <span class="text-red-500">*</span></label>
                            <input wire:model="address" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                            @error('address') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 my-8"></div>

                <!-- Room & Schedule -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Ruangan & Jadwal
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">Pilih Ruangan <span class="text-red-500">*</span></label>
                            <select wire:model="room_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium">
                                <option value="">Pilih Ruangan</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->code }}) - Kapasitas: {{ $room->capacity }} orang</option>
                                @endforeach
                            </select>
                            @error('room_id') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">Mulai <span class="text-red-500">*</span></label>
                            <input wire:model="start_datetime" type="datetime-local" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                            @error('start_datetime') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">Selesai <span class="text-red-500">*</span></label>
                            <input wire:model="end_datetime" type="datetime-local" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                            @error('end_datetime') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400">Maksimal durasi peminjaman: 7 hari</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 my-8"></div>

                <!-- Purpose & Notes -->
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">Tujuan Peminjaman <span class="text-red-500">*</span></label>
                        <textarea wire:model="purpose" rows="3" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" placeholder="Jelaskan tujuan/keperluan peminjaman ruangan..."></textarea>
                        @error('purpose') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">Catatan Tambahan</label>
                        <textarea wire:model="notes" rows="2" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" placeholder="Catatan atau permintaan khusus (opsional)"></textarea>
                        @error('notes') <span class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('room-borrowings.index') }}" class="mr-6 px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all duration-200">Batal</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
