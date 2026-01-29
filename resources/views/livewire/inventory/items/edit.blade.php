<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('admin.inventory.items.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Edit Inventory Item') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Update item details and status.') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <!-- Basic Information Section -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Basic Information') }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Name') }} <span class="text-red-500">*</span></label>
                            <input wire:model="name" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('name') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Category') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select wire:model="category_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="" class="dark:bg-gray-900">{{ __('Select Category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" class="dark:bg-gray-900">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            @error('category_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Brand') }}</label>
                            <input wire:model="brand" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('brand') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Model') }}</label>
                            <input wire:model="model" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('model') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Status & Location Section -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Status & Location') }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Laboratory') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select wire:model="laboratory_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="" class="dark:bg-gray-900">{{ __('Select Laboratory') }}</option>
                                    @foreach($laboratories as $lab)
                                        <option value="{{ $lab->id }}" class="dark:bg-gray-900">{{ $lab->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            @error('laboratory_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Condition') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select wire:model="condition" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="good" class="dark:bg-gray-900">{{ __('Good') }}</option>
                                    <option value="fair" class="dark:bg-gray-900">{{ __('Fair') }}</option>
                                    <option value="poor" class="dark:bg-gray-900">{{ __('Poor') }}</option>
                                    <option value="damaged" class="dark:bg-gray-900">{{ __('Damaged') }}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            @error('condition') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Status') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select wire:model="status" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="available" class="dark:bg-gray-900">{{ __('Available') }}</option>
                                    <option value="borrowed" class="dark:bg-gray-900">{{ __('Borrowed') }}</option>
                                    <option value="maintenance" class="dark:bg-gray-900">{{ __('Maintenance') }}</option>
                                    <option value="damaged" class="dark:bg-gray-900">{{ __('Damaged') }}</option>
                                    <option value="lost" class="dark:bg-gray-900">{{ __('Lost') }}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            @error('status') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Quantity') }} <span class="text-red-500">*</span></label>
                            <input wire:model="quantity" type="number" min="1" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('quantity') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Purchase Year') }}</label>
                            <input wire:model="purchase_year" type="number" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('purchase_year') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2 md:col-span-2" x-data="{
                            mode: 'upload',
                            stream: null,
                            captured: null,
                            cameraError: null,
                            loading: false,
                            facingMode: 'environment',
                            
                            async startCamera() {
                                this.loading = true;
                                this.cameraError = null;
                                try {
                                    // Check if HTTPS or localhost
                                    if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
                                        throw new Error('Kamera memerlukan HTTPS');
                                    }
                                    
                                    this.stream = await navigator.mediaDevices.getUserMedia({
                                        video: { 
                                            facingMode: this.facingMode,
                                            width: { ideal: 1280 },
                                            height: { ideal: 720 }
                                        },
                                        audio: false
                                    });
                                    this.$refs.video.srcObject = this.stream;
                                } catch (err) {
                                    console.error('Camera error:', err);
                                    if (err.name === 'NotAllowedError') {
                                        this.cameraError = 'Akses kamera ditolak. Silakan izinkan akses kamera.';
                                    } else if (err.name === 'NotFoundError') {
                                        this.cameraError = 'Kamera tidak ditemukan.';
                                    } else {
                                        this.cameraError = err.message || 'Gagal mengakses kamera.';
                                    }
                                    this.mode = 'upload';
                                }
                                this.loading = false;
                            },
                            
                            stopCamera() {
                                if (this.stream) {
                                    this.stream.getTracks().forEach(track => track.stop());
                                    this.stream = null;
                                }
                            },
                            
                            capturePhoto() {
                                const video = this.$refs.video;
                                const canvas = this.$refs.canvas;
                                canvas.width = video.videoWidth;
                                canvas.height = video.videoHeight;
                                canvas.getContext('2d').drawImage(video, 0, 0);
                                this.captured = canvas.toDataURL('image/jpeg', 0.8);
                                this.stopCamera();
                                
                                // Send to Livewire
                                $wire.dispatch('photo-captured', [this.captured]);
                            },
                            
                            retake() {
                                this.captured = null;
                                $wire.dispatch('photo-cleared');
                                this.startCamera();
                            },
                            
                            async switchCamera() {
                                this.facingMode = this.facingMode === 'environment' ? 'user' : 'environment';
                                this.stopCamera();
                                await this.startCamera();
                            },
                            
                            switchMode(newMode) {
                                if (newMode === 'camera' && this.mode !== 'camera') {
                                    this.mode = 'camera';
                                    this.startCamera();
                                } else if (newMode === 'upload') {
                                    this.mode = 'upload';
                                    this.stopCamera();
                                    this.captured = null;
                                    $wire.dispatch('photo-cleared');
                                }
                            }
                        }" x-init="$watch('mode', (value) => { if (value !== 'camera') stopCamera(); })">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white mb-3">{{ __('Item Photo') }}</label>
                            
                            <!-- Current Image Preview -->
                            @if($current_image)
                            <div class="mb-4 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $current_image) }}" alt="Current" class="w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Current photo') }}</p>
                                        <a href="{{ asset('storage/' . $current_image) }}" target="_blank" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('View full size') }}</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Mode Tabs -->
                            <div class="flex space-x-2 mb-4">
                                <button type="button" 
                                    @click="switchMode('upload')"
                                    :class="mode === 'upload' ? 'bg-indigo-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                                    class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    {{ __('Upload') }}
                                </button>
                                <button type="button" 
                                    @click="switchMode('camera')"
                                    :class="mode === 'camera' ? 'bg-indigo-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                                    class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ __('Camera') }}
                                </button>
                            </div>

                            <!-- Upload Mode -->
                            <div x-show="mode === 'upload'" x-transition>
                                <input wire:model="image" type="file" accept="image/*" class="w-full px-3 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 file:transition-colors" />
                                
                                @if($image)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('New image preview:') }}</p>
                                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-40 h-40 object-cover rounded-xl border-2 border-indigo-300 dark:border-indigo-600">
                                </div>
                                @endif
                            </div>

                            <!-- Camera Mode -->
                            <div x-show="mode === 'camera'" x-transition class="space-y-4">
                                <!-- Loading -->
                                <div x-show="loading" class="flex items-center justify-center py-8">
                                    <svg class="animate-spin h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="ml-2 text-gray-600 dark:text-gray-400">{{ __('Starting camera...') }}</span>
                                </div>

                                <!-- Error -->
                                <div x-show="cameraError" class="p-4 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800">
                                    <p class="text-red-600 dark:text-red-400 text-sm font-medium" x-text="cameraError"></p>
                                </div>

                                <!-- Video Preview -->
                                <div x-show="!captured && !loading && !cameraError" class="relative">
                                    <video x-ref="video" autoplay playsinline class="w-full max-w-md rounded-xl border-2 border-gray-300 dark:border-gray-600 bg-black"></video>
                                    
                                    <!-- Camera Controls -->
                                    <div class="flex items-center justify-center space-x-4 mt-4">
                                        <button type="button" @click="capturePhoto()" class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ __('Capture') }}
                                        </button>
                                        <button type="button" @click="switchCamera()" class="p-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-xl transition-all duration-200" title="{{ __('Switch Camera') }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Captured Image Preview -->
                                <div x-show="captured" class="space-y-4">
                                    <img :src="captured" alt="Captured" class="w-full max-w-md rounded-xl border-2 border-green-400 dark:border-green-600 shadow-lg">
                                    <div class="flex items-center space-x-3">
                                        <span class="text-green-600 dark:text-green-400 text-sm font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            {{ __('Photo captured!') }}
                                        </span>
                                        <button type="button" @click="retake()" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-sm font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                            {{ __('Retake') }}
                                        </button>
                                    </div>
                                </div>

                                <!-- Hidden Canvas for Capture -->
                                <canvas x-ref="canvas" class="hidden"></canvas>
                            </div>
                            
                            @error('image') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8 space-y-2">
                    <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Description') }}</label>
                    <textarea wire:model="description" rows="4" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium"></textarea>
                    @error('description') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-end mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.inventory.items.index') }}" class="mr-6 px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Update Item') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
