<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Informasi Profil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Perbarui informasi profil dan alamat email akun Anda.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Foto Profil') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Pilih Foto Baru') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Hapus Foto') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nama Lengkap') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- NIP/NIM -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nip_nim" value="{{ __('NIP / NIM') }}" />
            @if(auth()->user()->role === 'super_admin')
                {{-- Super Admin can edit NIP/NIM --}}
                <x-input id="nip_nim" type="text" class="mt-1 block w-full" wire:model="state.nip_nim" />
                <x-input-error for="nip_nim" class="mt-2" />
            @else
                {{-- Other users cannot edit NIP/NIM --}}
                <x-input id="nip_nim" type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 cursor-not-allowed" value="{{ $this->user->nip_nim ?? '-' }}" disabled />
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">NIP/NIM tidak dapat diubah. Hubungi Administrator jika ada kesalahan.</p>
            @endif
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('Alamat email Anda belum diverifikasi.') }}

                    <button type="button" class="underline text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" wire:click.prevent="sendEmailVerification">
                        {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('Nomor Telepon') }}" />
            <x-input id="phone" type="tel" class="mt-1 block w-full" wire:model="state.phone" autocomplete="tel" placeholder="Contoh: 08123456789" />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Study Program -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="study_program" value="{{ __('Program Studi') }}" />
            <select id="study_program" wire:model="state.study_program" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">-- Pilih Program Studi --</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Teknik Elektro">Teknik Elektro</option>
                <option value="Teknik Sipil">Teknik Sipil</option>
                <option value="Teknik Mesin">Teknik Mesin</option>
                <option value="Teknik Kimia">Teknik Kimia</option>
                <option value="Teknik Pertambangan">Teknik Pertambangan</option>
                <option value="Teknik Geologi">Teknik Geologi</option>
                <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                <option value="Arsitektur">Arsitektur</option>
            </select>
            <x-input-error for="study_program" class="mt-2" />
        </div>

        <!-- Role (Read Only) -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="role" value="{{ __('Peran') }}" />
            @php
                $roleLabels = [
                    'super_admin' => 'Super Admin',
                    'head_of_lab' => 'Kepala Lab',
                    'lecturer' => 'Dosen',
                    'lab_assistant' => 'Asisten Lab',
                    'student' => 'Mahasiswa',
                ];
            @endphp
            <x-input id="role" type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 cursor-not-allowed" value="{{ $roleLabels[$this->user->role] ?? ucfirst($this->user->role) }}" disabled />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Peran hanya dapat diubah oleh Administrator.</p>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Tersimpan.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Simpan') }}
        </x-button>
    </x-slot>
</x-form-section>
