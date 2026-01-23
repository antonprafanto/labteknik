# Sistem Manajemen Laboratorium Teknik (Lab Teknik 2026)

Platform terintegrasi untuk pengelolaan inventaris, peminjaman alat, penjadwalan praktikum, dan pelaporan kerusakan di lingkungan Fakultas Teknik Universitas Mulawarman.

## Fitur Utama

-   **Manajemen Inventaris**: CRUD barang, kategori, dan pelacakan lokasi laboratorium.
-   **Peminjaman Digital**: Pengajuan, persetujuan, dan pelacakan status peminjaman alat.
-   **Laporan Kerusakan**: Pelaporan kerusakan dengan bukti foto dan pelacakan status perbaikan.
-   **Jadwal Praktikum**: Manajemen jadwal penggunaan laboratorium.
-   **Laporan & Statistik**: Dashboard analitik dengan ekspor PDF.
-   **Notifikasi Email**: Pemberitahuan otomatis untuk status peminjaman dan laporan kerusakan baru.
-   **Mobile Friendly**: Tampilan responsif untuk akses via smartphone.

## Persyaratan Sistem

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   MySQL

## Instalasi

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/lab-teknik-2026.git
    cd lab_teknik2026
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Sesuaikan konfigurasi database di file `.env`.

4.  **Migrasi Database**
    ```bash
    php artisan migrate --seed
    ```

5.  **Jalankan Server**
    ```bash
    # Terminal 1
    php artisan serve

    # Terminal 2
    npm run dev
    ```

## Akun Demo

-   **Super Admin**: admin@example.com / password
-   **Kepala Lab**: head@example.com / password
-   **Mahasiswa**: student@example.com / password

## Fitur Baru (Update Terakhir)

-   **Ekspor PDF**: Laporan inventaris dan statistik dapat diekspor ke format PDF resmi.
-   **Email Notifikasi**: Integrasi email menggunakan SMTP (konfigurasi di `.env`).
-   **Mode Bahasa Indonesia**: Antarmuka sepenuhnya dalam Bahasa Indonesia.
-   **Halaman Bantuan**: Dokumentasi pengguna tersedia di menu `/help`.

## Lisensi

Aplikasi ini bersifat open-source di bawah lisensi [MIT](https://opensource.org/licenses/MIT).
