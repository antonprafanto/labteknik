Baik, saya akan menyisir seluruh tampilan antarmuka (UI) untuk memastikan konsistensi Bahasa Indonesia. Saya menemukan bahwa konfigurasi dasar aplikasi masih menggunakan 'en' (Inggris), dan beberapa komponen yang baru saja kita ubah masih menggunakan label bahasa Inggris.

Berikut adalah rencana perbaikan bahasa:

### 1. Konfigurasi Dasar ⚙️
*   Mengubah locale default aplikasi di `config/app.php` dari `en` menjadi `id` agar format tanggal dan pesan sistem otomatis menyesuaikan.

### 2. Penerjemahan Menu Navigasi (`navigation-menu.blade.php`) 🧭
*   Mengubah label menu dropdown:
    *   *Administration* -> **Administrasi**
    *   *Activities* -> **Aktivitas**
    *   *Schedules* -> **Jadwal**
    *   *Inventory Items* -> **Data Barang**
    *   *Reports & Stats* -> **Laporan & Statistik**
    *   *Users Management* -> **Manajemen Pengguna**
    *   *My Borrowings* -> **Peminjaman Saya**
    *   *Approvals* -> **Persetujuan**
    *   *Schedule List* -> **Daftar Jadwal**
    *   *Calendar View* -> **Kalender**

### 3. Penerjemahan Dashboard (`welcome.blade.php`) 🏠
*   Menerjemahkan judul dan deskripsi pada kartu akses cepat (Quick Access Cards).
*   *Analytics Dashboard* -> **Dashboard Analitik**
*   *Inventory Management* -> **Manajemen Inventaris**
*   *Issue Reporting* -> **Pelaporan Masalah**

### 4. Penerjemahan Halaman Scan & Notifikasi 🔔
*   **Halaman Scan**: Mengubah instruksi "Point your camera..." menjadi Bahasa Indonesia yang baku.
*   **Notifikasi**: Mengubah pesan "View all notifications", "Mark all read", dll.

Saya akan mulai mengeksekusi penerjemahan ini satu per satu. Apakah Anda setuju?