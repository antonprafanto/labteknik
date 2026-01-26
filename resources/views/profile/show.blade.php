<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            {{-- User Profile Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="relative">
                    {{-- Cover Background --}}
                    <div class="h-32 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-800"></div>
                    
                    {{-- Profile Content --}}
                    <div class="px-6 pb-6">
                        {{-- Avatar --}}
                        <div class="flex flex-col sm:flex-row sm:items-end -mt-16 sm:-mt-12">
                            <div class="relative">
                                <img src="{{ auth()->user()->profile_photo_url }}" 
                                     alt="{{ auth()->user()->name }}" 
                                     class="w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white dark:border-gray-800 object-cover shadow-lg">
                                
                                {{-- Status Badge --}}
                                @if(auth()->user()->is_active)
                                    <span class="absolute bottom-2 right-2 w-5 h-5 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full" title="Aktif"></span>
                                @else
                                    <span class="absolute bottom-2 right-2 w-5 h-5 bg-red-500 border-2 border-white dark:border-gray-800 rounded-full" title="Tidak Aktif"></span>
                                @endif
                            </div>
                            
                            <div class="mt-4 sm:mt-0 sm:ml-6 sm:pb-2">
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ auth()->user()->name }}
                                </h1>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            
                            <div class="mt-4 sm:mt-0 sm:ml-auto sm:pb-2">
                                {{-- Role Badge --}}
                                @php
                                    $roleColors = [
                                        'super_admin' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                        'head_of_lab' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                        'lecturer' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                        'lab_assistant' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                        'student' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                    ];
                                    $roleLabels = [
                                        'super_admin' => 'Super Admin',
                                        'head_of_lab' => 'Kepala Lab',
                                        'lecturer' => 'Dosen',
                                        'lab_assistant' => 'Asisten Lab',
                                        'student' => 'Mahasiswa',
                                    ];
                                    $role = auth()->user()->role ?? 'student';
                                @endphp
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $roleColors[$role] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $roleLabels[$role] ?? ucfirst($role) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- User Information Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {{-- Personal Information --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Pribadi</h3>
                    </div>
                    
                    <dl class="space-y-4">
                        <div class="flex justify-between py-3 border-b border-gray-100 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium">{{ auth()->user()->name }}</dd>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">NIP / NIM</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium">{{ auth()->user()->nip_nim ?? '-' }}</dd>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium flex items-center">
                                {{ auth()->user()->email }}
                                @if(auth()->user()->hasVerifiedEmail())
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Terverifikasi
                                    </span>
                                @else
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                        Belum Verifikasi
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div class="flex justify-between py-3">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Telepon</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium">{{ auth()->user()->phone ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Academic Information --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Akademik</h3>
                    </div>
                    
                    <dl class="space-y-4">
                        <div class="flex justify-between py-3 border-b border-gray-100 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Peran</dt>
                            <dd class="text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $roleColors[$role] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $roleLabels[$role] ?? ucfirst($role) }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Program Studi</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium">{{ auth()->user()->study_program ?? '-' }}</dd>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Laboratorium</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium">{{ auth()->user()->laboratory?->name ?? '-' }}</dd>
                        </div>
                        <div class="flex justify-between py-3">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status Akun</dt>
                            <dd class="text-sm">
                                @if(auth()->user()->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                        <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                        <span class="w-2 h-2 mr-1.5 bg-red-500 rounded-full"></span>
                                        Tidak Aktif
                                    </span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Account Statistics --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <div class="flex items-center mb-4">
                    <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Statistik Akun</h3>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                            {{ auth()->user()->borrowingRequests()->count() }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Peminjaman</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                            {{ auth()->user()->borrowingRequests()->where('status', 'approved')->count() }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Disetujui</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                            {{ auth()->user()->borrowingRequests()->where('status', 'pending')->count() }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Menunggu</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                            {{ auth()->user()->created_at->diffInDays(now()) }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Hari Bergabung</div>
                    </div>
                </div>
            </div>

            {{-- Account Timestamps --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <div class="flex items-center mb-4">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Riwayat Akun</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Akun Dibuat</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Email Diverifikasi</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ auth()->user()->email_verified_at ? auth()->user()->email_verified_at->translatedFormat('d F Y, H:i') : 'Belum diverifikasi' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Terakhir Diperbarui</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->updated_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings Sections --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pengaturan Akun</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Kelola informasi profil, keamanan, dan preferensi akun Anda.</p>
                </div>
            </div>

            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="mt-6">
                    @livewire('profile.update-profile-information-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
