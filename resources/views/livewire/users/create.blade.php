<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <!-- Decorative gradient line -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                
                <div class="flex items-center">
                    <a href="{{ route('users.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Create New User') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Add a new user account to the system.') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Name') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="name" wire:model="name" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="Full Name">
                        @error('name') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Email') }} <span class="text-red-500">*</span></label>
                        <input type="email" id="email" wire:model="email" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="email@example.com">
                        @error('email') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Password') }} <span class="text-red-500">*</span></label>
                        <input type="password" id="password" wire:model="password" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="********">
                        @error('password') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</span> @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Confirm Password') }} <span class="text-red-500">*</span></label>
                        <input type="password" id="password_confirmation" wire:model="password_confirmation" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="********">
                    </div>

                    <!-- Role -->
                    <div class="space-y-2">
                        <label for="role" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Role') }} <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="role" wire:model.live="role" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                <option value="student" class="text-gray-900">{{ __('Student') }}</option>
                                <option value="lecturer" class="text-gray-900">{{ __('Lecturer') }}</option>
                                <option value="lab_assistant" class="text-gray-900">{{ __('Lab Assistant') }}</option>
                                <option value="head_of_lab" class="text-gray-900">{{ __('Head of Lab') }}</option>
                                <option value="super_admin" class="text-gray-900">{{ __('Super Admin') }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @error('role') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</span> @enderror
                    </div>

                    <!-- NIP/NIM -->
                    <div class="space-y-2">
                        <label for="nip_nim" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('NIP / NIM') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="nip_nim" wire:model="nip_nim" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium">
                        @error('nip_nim') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone -->
                    <div class="space-y-2">
                        <label for="phone" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Phone') }}</label>
                        <input type="text" id="phone" wire:model="phone" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium">
                        @error('phone') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</span> @enderror
                    </div>

                    <!-- Study Program -->
                    <div class="space-y-2">
                        <label for="study_program" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Study Program') }}</label>
                        <input type="text" id="study_program" wire:model="study_program" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium">
                        @error('study_program') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</span> @enderror
                    </div>

                    <!-- Laboratory Assignment (Conditional) -->
                    @if($role === 'head_of_lab' || $role === 'lab_assistant')
                        <div class="space-y-2 md:col-span-2">
                            <label for="laboratory_id" class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Assigned Laboratory') }}</label>
                            <div class="relative">
                                <select id="laboratory_id" wire:model="laboratory_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="" class="text-gray-900">{{ __('Select Laboratory') }}</option>
                                    @foreach($laboratories as $lab)
                                        <option value="{{ $lab->id }}" class="text-gray-900">{{ $lab->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('laboratory_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <!-- Active Status -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="flex items-center p-5 bg-gray-50 dark:bg-gray-700/50 rounded-xl border-2 border-gray-200 dark:border-gray-600 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700/70 transition-all duration-200">
                            <input type="checkbox" id="is_active" wire:model="is_active" class="w-5 h-5 rounded border-gray-300 dark:border-gray-500 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <span class="ml-4 text-sm font-bold text-gray-900 dark:text-white">{{ __('Active Account') }}</span>
                            <span class="ml-2 text-xs text-gray-600 dark:text-gray-300 font-medium">({{ __('User can log in to the system') }})</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('users.index') }}" class="mr-6 px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        {{ __('Create User') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


