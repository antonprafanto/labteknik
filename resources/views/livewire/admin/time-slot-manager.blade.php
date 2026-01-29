<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-600 to-purple-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white">⏰ Pengaturan Slot Waktu</h2>
                        <p class="text-indigo-200 mt-1">Atur jam praktikum untuk tampilan jadwal</p>
                    </div>
                    <a href="{{ route('schedules.index') }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors">
                        ← Kembali
                    </a>
                </div>
            </div>

            <div class="p-6">
                <!-- Filters -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Laboratorium</label>
                        <select wire:model.live="laboratory_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">📌 Global (Semua Lab)</option>
                            @foreach($laboratories as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Global = berlaku untuk semua lab yang tidak punya pengaturan sendiri</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe Hari</label>
                        <div class="flex gap-2">
                            <button wire:click="$set('is_friday', false)" class="flex-1 px-4 py-2 rounded-lg font-medium transition-colors {{ !$is_friday ? 'bg-indigo-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                                📅 Senin - Kamis
                            </button>
                            <button wire:click="$set('is_friday', true)" class="flex-1 px-4 py-2 rounded-lg font-medium transition-colors {{ $is_friday ? 'bg-emerald-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                                🕌 Jumat
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Copy from Global -->
                @if($laboratory_id && count($timeSlotsList) == 0)
                    <div class="mb-6 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg">
                        <p class="text-amber-800 dark:text-amber-300 text-sm mb-2">
                            Lab ini belum punya slot waktu. Anda bisa menyalin dari pengaturan global.
                        </p>
                        <button wire:click="copyFromGlobal" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-sm font-medium">
                            📋 Salin dari Global
                        </button>
                    </div>
                @endif

                <!-- Add/Edit Form -->
                <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        {{ $editingSlotId ? '✏️ Edit Slot' : '➕ Tambah Slot Baru' }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jam Mulai</label>
                            <div class="relative">
                                <input type="time" wire:model="start_time" class="custom-time-input w-full px-3 py-2 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 dark:text-gray-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            @error('start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jam Selesai</label>
                            <div class="relative">
                                <input type="time" wire:model="end_time" class="custom-time-input w-full px-3 py-2 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 dark:text-gray-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" wire:model.live="is_break" class="w-5 h-5 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Waktu Istirahat</span>
                            </label>
                        </div>
                        @if($is_break)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Label</label>
                                <input type="text" wire:model="break_label" placeholder="Istirahat Sholat Jumat" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        @endif
                    </div>
                    <div class="mt-4 flex gap-2">
                        @if($editingSlotId)
                            <button wire:click="updateSlot" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium">
                                💾 Simpan Perubahan
                            </button>
                            <button wire:click="resetForm" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-white rounded-lg font-medium">
                                ✖️ Batal
                            </button>
                        @else
                            <button wire:click="createSlot" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium">
                                ➕ Tambah Slot
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Slots List -->
                <div class="space-y-2">
                    @forelse($timeSlotsList as $index => $slot)
                        <div class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:shadow-md transition-shadow {{ $slot['is_break'] ? 'bg-emerald-50 dark:bg-emerald-900/20 border-emerald-200 dark:border-emerald-800' : '' }}">
                            <div class="flex flex-col gap-1">
                                <button wire:click="moveUp({{ $slot['id'] }})" class="p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 {{ $index == 0 ? 'opacity-30 cursor-not-allowed' : '' }}" {{ $index == 0 ? 'disabled' : '' }}>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                </button>
                                <button wire:click="moveDown({{ $slot['id'] }})" class="p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 {{ $index == count($timeSlotsList) - 1 ? 'opacity-30 cursor-not-allowed' : '' }}" {{ $index == count($timeSlotsList) - 1 ? 'disabled' : '' }}>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($slot['start_time'])->format('H:i') }} - {{ \Carbon\Carbon::parse($slot['end_time'])->format('H:i') }}
                                    </span>
                                    @if($slot['is_break'])
                                        <span class="px-2 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 text-xs font-medium rounded-full">
                                            🕌 {{ $slot['break_label'] ?? 'Istirahat' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="editSlot({{ $slot['id'] }})" class="p-2 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button wire:click="deleteSlot({{ $slot['id'] }})" wire:confirm="Hapus slot waktu ini?" class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="font-medium">Belum ada slot waktu</p>
                            <p class="text-sm">Tambahkan slot waktu baru menggunakan form di atas</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
