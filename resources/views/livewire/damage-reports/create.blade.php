<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('damage-reports.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Report Item Damage') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Report damage or malfunction of laboratory equipment.') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Searchable Item Dropdown -->
                    <div class="col-span-1 md:col-span-2" x-data="{
                        open: false,
                        search: '',
                        items: @js($items->map(fn($i) => ['id' => $i->id, 'name' => $i->name, 'code' => $i->code, 'brand' => $i->brand])),
                        selectedLabel: '',
                        get filteredItems() {
                            if (!this.search) return this.items;
                            const s = this.search.toLowerCase();
                            return this.items.filter(i => i.name.toLowerCase().includes(s) || i.code.toLowerCase().includes(s) || i.brand.toLowerCase().includes(s));
                        },
                        selectItem(item) {
                            @this.set('inventory_item_id', item.id);
                            this.selectedLabel = item.name + ' (' + item.code + ')';
                            this.search = '';
                            this.open = false;
                        },
                        clear() {
                            @this.set('inventory_item_id', '');
                            this.selectedLabel = '';
                            this.search = '';
                        }
                    }" @click.outside="open = false">
                        <label class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Select Item') }}</label>
                        <div class="relative">
                            <!-- Display selected or search input -->
                            <div @click="open = !open" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus-within:border-red-500 focus-within:ring-1 focus-within:ring-red-500 shadow-sm transition-all duration-200 font-medium cursor-pointer flex items-center justify-between">
                                <template x-if="selectedLabel && !open">
                                    <div class="flex items-center justify-between w-full">
                                        <span x-text="selectedLabel"></span>
                                        <button type="button" @click.stop="clear()" class="ml-2 text-gray-400 hover:text-red-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="!selectedLabel && !open">
                                    <span class="text-gray-400">{{ __('-- Select Item --') }}</span>
                                </template>
                                <template x-if="open">
                                    <input type="text" x-model="search" @click.stop x-ref="searchInput" autofocus
                                        placeholder="{{ __('Type to search...') }}"
                                        class="w-full bg-transparent border-0 p-0 focus:ring-0 text-gray-900 dark:text-white placeholder-gray-400 font-medium">
                                </template>
                            </div>
                            <template x-if="open">
                                <div x-init="$nextTick(() => $refs.searchInput?.focus())" class="absolute z-20 w-full bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-600 mt-2 rounded-xl shadow-xl max-h-60 overflow-y-auto">
                                    <template x-for="item in filteredItems" :key="item.id">
                                        <div @click="selectItem(item)" class="cursor-pointer hover:bg-red-50 dark:hover:bg-red-900/20 p-4 border-b border-gray-100 dark:border-gray-700 last:border-0 transition-colors">
                                            <div class="font-bold text-gray-900 dark:text-white" x-text="item.name"></div>
                                            <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 mt-1" x-text="item.code + ' - ' + item.brand"></div>
                                        </div>
                                    </template>
                                    <template x-if="filteredItems.length === 0">
                                        <div class="p-4 text-sm text-gray-400 text-center">{{ __('No items found.') }}</div>
                                    </template>
                                </div>
                            </template>
                        </div>
                        @error('inventory_item_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-2 font-medium">{{ __('Please select a valid item.') }}</span> @enderror
                    </div>

                    <!-- Damage Type -->
                    <div>
                        <label for="damage_type" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Damage Severity') }}</label>
                        <select id="damage_type" wire:model="damage_type" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-red-500 focus:ring-red-500 shadow-sm transition-all duration-200 font-medium">
                            <option value="">{{ __('Select Severity') }}</option>
                            <option value="ringan">{{ __('Light (Ringan)') }}</option>
                            <option value="sedang">{{ __('Moderate (Sedang)') }}</option>
                            <option value="berat">{{ __('Heavy (Berat)') }}</option>
                            <option value="total">{{ __('Total Loss (Total)') }}</option>
                        </select>
                        @error('damage_type') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Photo Evidence (Camera) -->
                    <div x-data="{
                        showCamera: false,
                        stream: null,
                        preview: null,
                        async openCamera() {
                            this.showCamera = true;
                            await this.$nextTick();
                            try {
                                this.stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment', width: { ideal: 1280 }, height: { ideal: 720 } } });
                                this.$refs.video.srcObject = this.stream;
                            } catch(e) {
                                alert('{{ __('Cannot access camera. Please allow camera permission.') }}');
                                this.showCamera = false;
                            }
                        },
                        capture() {
                            const video = this.$refs.video;
                            const canvas = this.$refs.canvas;
                            canvas.width = video.videoWidth;
                            canvas.height = video.videoHeight;
                            canvas.getContext('2d').drawImage(video, 0, 0);
                            canvas.toBlob(blob => {
                                const file = new File([blob], 'damage-photo-' + Date.now() + '.jpg', { type: 'image/jpeg' });
                                const dt = new DataTransfer();
                                dt.items.add(file);
                                this.$refs.fileInput.files = dt.files;
                                this.$refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                                this.preview = canvas.toDataURL('image/jpeg');
                                this.stopCamera();
                            }, 'image/jpeg', 0.85);
                        },
                        stopCamera() {
                            if (this.stream) {
                                this.stream.getTracks().forEach(t => t.stop());
                                this.stream = null;
                            }
                            this.showCamera = false;
                        },
                        retake() {
                            this.preview = null;
                            @this.set('image', null);
                            this.openCamera();
                        }
                    }" x-on:livewire:navigating.window="stopCamera()">
                        <label class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Photo Evidence (Optional)') }}</label>

                        <input type="file" x-ref="fileInput" wire:model="image" accept="image/*" class="hidden">

                        <!-- Camera Actions -->
                        <template x-if="!showCamera && !preview">
                            <button type="button" @click="openCamera()" class="inline-flex items-center px-6 py-3 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 font-bold rounded-xl border-2 border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/50 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ __('Take Photo') }}
                            </button>
                        </template>

                        <!-- Camera View -->
                        <template x-if="showCamera">
                            <div class="space-y-3">
                                <div class="relative rounded-xl overflow-hidden border-2 border-red-300 dark:border-red-700">
                                    <video x-ref="video" autoplay playsinline class="w-full rounded-xl"></video>
                                </div>
                                <div class="flex gap-3">
                                    <button type="button" @click="capture()" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-orange-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ __('Capture') }}
                                    </button>
                                    <button type="button" @click="stopCamera()" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold rounded-xl transition-all duration-200">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                                <canvas x-ref="canvas" class="hidden"></canvas>
                            </div>
                        </template>

                        <!-- Preview -->
                        <template x-if="preview">
                            <div class="space-y-3">
                                <div class="relative rounded-xl overflow-hidden border-2 border-green-300 dark:border-green-700">
                                    <img :src="preview" class="w-full rounded-xl" alt="Preview">
                                </div>
                                <button type="button" @click="retake()" class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    {{ __('Retake') }}
                                </button>
                            </div>
                        </template>

                        @error('image') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror

                        <div wire:loading wire:target="image" class="text-sm text-gray-500 dark:text-gray-400 mt-2 flex items-center font-medium">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ __('Uploading...') }}
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="description" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Description of Damage') }}</label>
                        <textarea id="description" wire:model="description" rows="4" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-red-500 focus:ring-red-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="{{ __('Describe how the damage happened and the current state of the item...') }}"></textarea>
                        @error('description') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 gap-4">
                    <a href="{{ route('damage-reports.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 font-bold rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        {{ __('Submit Report') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

