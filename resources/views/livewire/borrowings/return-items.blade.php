<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('borrowings.approval') }}" class="mr-4 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-2 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Proses Pengembalian') }}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $borrowingRequest->request_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            @if (session()->has('message'))
                <div class="mx-6 mt-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="mx-6 mt-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Borrowing Info -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-4">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Peminjam') }}</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $borrowingRequest->user->name }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-4">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Tanggal Pinjam') }}</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $borrowingRequest->borrow_date->format('d M Y') }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-4">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Target Kembali') }}</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $borrowingRequest->return_date->format('d M Y') }}</p>
                        @if($borrowingRequest->return_date->isPast())
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 mt-1">
                                {{ __('Terlambat') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Items List -->
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    {{ __('Daftar Barang') }} ({{ count($borrowingRequest->items) }})
                </h3>

                <div class="space-y-6">
                    @foreach($borrowingRequest->items as $item)
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden" 
                         x-data="returnItemCamera{{ $item->id }}()"
                         x-init="init()">
                        <!-- Item Header -->
                        <div class="p-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 flex items-center justify-center bg-indigo-100 dark:bg-indigo-900/30 rounded-xl mr-4">
                                        @if($item->inventoryItem->image_path)
                                            <img src="{{ Storage::url($item->inventoryItem->image_path) }}" alt="{{ $item->inventoryItem->name }}" class="w-10 h-10 object-cover rounded-lg">
                                        @else
                                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $item->inventoryItem->name }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->inventoryItem->code }} • Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-sm font-medium rounded-full
                                    {{ $returnConditions[$item->id] === 'good' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : '' }}
                                    {{ $returnConditions[$item->id] === 'damaged' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : '' }}
                                    {{ $returnConditions[$item->id] === 'lost' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}">
                                    {{ $returnConditions[$item->id] === 'good' ? __('Baik') : ($returnConditions[$item->id] === 'damaged' ? __('Rusak') : __('Hilang')) }}
                                </span>
                            </div>
                        </div>

                        <!-- Item Form -->
                        <div class="p-4 space-y-4">
                            <!-- Condition Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Kondisi Barang') }}</label>
                                <div class="flex flex-wrap gap-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" wire:model.live="returnConditions.{{ $item->id }}" value="good" 
                                               class="form-radio text-emerald-600 focus:ring-emerald-500">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">✓ {{ __('Baik') }}</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" wire:model.live="returnConditions.{{ $item->id }}" value="damaged"
                                               class="form-radio text-amber-600 focus:ring-amber-500">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">⚠ {{ __('Rusak') }}</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" wire:model.live="returnConditions.{{ $item->id }}" value="lost"
                                               class="form-radio text-red-600 focus:ring-red-500">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">✕ {{ __('Hilang') }}</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Damage Report Form (shown if damaged) -->
                            @if($returnConditions[$item->id] === 'damaged')
                            <div class="bg-amber-50 dark:bg-amber-900/20 rounded-lg p-4 border border-amber-200 dark:border-amber-800">
                                <h4 class="text-sm font-semibold text-amber-800 dark:text-amber-400 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    {{ __('Detail Kerusakan (akan dibuat Damage Report)') }}
                                </h4>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">{{ __('Tingkat Kerusakan') }}</label>
                                        <select wire:model="damageSeverities.{{ $item->id }}" class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:ring-amber-500 focus:border-amber-500">
                                            <option value="low">{{ __('Ringan') }}</option>
                                            <option value="medium">{{ __('Sedang') }}</option>
                                            <option value="high">{{ __('Berat') }}</option>
                                            <option value="critical">{{ __('Kritis') }}</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">{{ __('Deskripsi Kerusakan') }} *</label>
                                        <textarea wire:model="damageDescriptions.{{ $item->id }}" rows="2" 
                                                  class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:ring-amber-500 focus:border-amber-500"
                                                  placeholder="{{ __('Jelaskan kerusakan yang terjadi...') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Notes -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Catatan (opsional)') }}</label>
                                <input type="text" wire:model="returnNotes.{{ $item->id }}" 
                                       class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="{{ __('Catatan tambahan...') }}">
                            </div>

                            <!-- Camera Capture -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Foto Bukti') }} *</label>
                                
                                <!-- Preview captured photo -->
                                <template x-if="captured">
                                    <div class="relative">
                                        <img :src="captured" class="w-full max-w-md rounded-lg border-2 border-emerald-500">
                                        <button @click="retake()" type="button"
                                                class="absolute top-2 right-2 px-3 py-1 bg-gray-800/80 text-white text-sm rounded-lg hover:bg-gray-900">
                                            {{ __('Ambil Ulang') }}
                                        </button>
                                    </div>
                                </template>

                                <!-- Camera/Upload UI -->
                                <template x-if="!captured">
                                    <div class="space-y-3">
                                        <!-- Video preview -->
                                        <template x-if="showCamera">
                                            <div class="relative">
                                                <video x-ref="video" autoplay playsinline class="w-full max-w-md rounded-lg bg-gray-900"></video>
                                                <canvas x-ref="canvas" class="hidden"></canvas>
                                                <div class="flex gap-2 mt-2">
                                                    <button @click="capturePhoto()" type="button"
                                                            class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                                                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                        {{ __('Ambil Foto') }}
                                                    </button>
                                                    <button @click="stopCamera()" type="button"
                                                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                                                        {{ __('Batal') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </template>

                                        <!-- Start camera button -->
                                        <template x-if="!showCamera">
                                            <button @click="startCamera()" type="button"
                                                    class="flex items-center justify-center w-full max-w-md px-4 py-8 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-indigo-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                                <div class="text-center">
                                                    <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('Klik untuk membuka kamera') }}</p>
                                                </div>
                                            </button>
                                        </template>

                                        <!-- Error message -->
                                        <template x-if="error">
                                            <div class="text-sm text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 px-3 py-2 rounded-lg">
                                                <span x-text="error"></span>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <script>
                        function returnItemCamera{{ $item->id }}() {
                            return {
                                showCamera: false,
                                captured: @entangle('capturedPhotos.' . $item->id),
                                stream: null,
                                error: null,

                                init() {
                                    // Cleanup on component destroy
                                },

                                async startCamera() {
                                    this.error = null;
                                    try {
                                        this.stream = await navigator.mediaDevices.getUserMedia({
                                            video: { facingMode: 'environment' },
                                            audio: false
                                        });
                                        this.showCamera = true;
                                        await this.$nextTick();
                                        if (this.$refs.video) {
                                            this.$refs.video.srcObject = this.stream;
                                        }
                                    } catch (err) {
                                        this.error = 'Tidak dapat mengakses kamera: ' + err.message;
                                    }
                                },

                                stopCamera() {
                                    if (this.stream) {
                                        this.stream.getTracks().forEach(track => track.stop());
                                        this.stream = null;
                                    }
                                    this.showCamera = false;
                                },

                                capturePhoto() {
                                    const video = this.$refs.video;
                                    const canvas = this.$refs.canvas;
                                    canvas.width = video.videoWidth;
                                    canvas.height = video.videoHeight;
                                    canvas.getContext('2d').drawImage(video, 0, 0);
                                    this.captured = canvas.toDataURL('image/jpeg', 0.8);
                                    this.stopCamera();
                                    
                                    // Notify Livewire
                                    $wire.dispatch('photo-captured', { itemId: {{ $item->id }}, photo: this.captured });
                                },

                                retake() {
                                    this.captured = null;
                                    $wire.dispatch('photo-cleared', { itemId: {{ $item->id }} });
                                }
                            }
                        }
                    </script>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="p-6 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('borrowings.approval') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        {{ __('Batal') }}
                    </a>
                    <button wire:click="processReturn" wire:loading.attr="disabled"
                            class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span wire:loading.remove>{{ __('Proses Pengembalian') }}</span>
                        <span wire:loading>{{ __('Memproses...') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
