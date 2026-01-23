<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex items-center">
                    <a href="{{ route('users.index') }}" class="mr-4 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ __('Edit User') }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $user->name }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Name') }}</label>
                        <input type="text" id="name" wire:model="name" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                        @error('name') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Email') }}</label>
                        <input type="email" id="email" wire:model="email" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                        @error('email') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Password (Leave blank to keep current)') }}</label>
                        <input type="password" id="password" wire:model="password" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                        @error('password') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Confirm Password') }}</label>
                        <input type="password" id="password_confirmation" wire:model="password_confirmation" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Role') }}</label>
                        <select id="role" wire:model.live="role" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                            <option value="student">{{ __('Student') }}</option>
                            <option value="lecturer">{{ __('Lecturer') }}</option>
                            <option value="lab_assistant">{{ __('Lab Assistant') }}</option>
                            <option value="head_of_lab">{{ __('Head of Lab') }}</option>
                            <option value="super_admin">{{ __('Super Admin') }}</option>
                        </select>
                        @error('role') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- NIP/NIM -->
                    <div>
                        <label for="nip_nim" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('NIP / NIM') }}</label>
                        <input type="text" id="nip_nim" wire:model="nip_nim" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                        @error('nip_nim') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Phone') }}</label>
                        <input type="text" id="phone" wire:model="phone" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                        @error('phone') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Study Program -->
                    <div>
                        <label for="study_program" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Study Program') }}</label>
                        <input type="text" id="study_program" wire:model="study_program" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                        @error('study_program') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Laboratory Assignment (Conditional) -->
                    @if($role === 'head_of_lab' || $role === 'lab_assistant')
                        <div>
                            <label for="laboratory_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Assigned Laboratory') }}</label>
                            <select id="laboratory_id" wire:model="laboratory_id" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                                <option value="">{{ __('Select Laboratory') }}</option>
                                @foreach($laboratories as $lab)
                                    <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                                @endforeach
                            </select>
                            @error('laboratory_id') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <!-- Active Status -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="flex items-center p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-100 dark:border-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">
                            <input type="checkbox" id="is_active" wire:model="is_active" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Active Account') }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('users.index') }}" class="mr-4 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Update User') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

