Baik, mari kita lanjutkan untuk mengimplementasikan fitur **Notifikasi Real-time (Lonceng/Bell)**. 🔔

Ini akan melengkapi fitur scan QR yang baru saja kita buat, sehingga Admin/Laboran bisa langsung tahu jika ada permintaan baru atau laporan kerusakan tanpa harus reload halaman.

Berikut adalah rencana kerjanya:

### 1. Persiapan Database 🗄️
- Menjalankan perintah artisan untuk membuat tabel `notifications` bawaan Laravel.
- Migrasi database agar tabel terbentuk.

### 2. Backend Logic (Pemicu Notifikasi) ⚙️
- Membuat Class Notifikasi Laravel: `App\Notifications\BorrowingStatusUpdated` dan `NewDamageReport`.
- Mengupdate logika `BorrowingController` dan `DamageReport` agar mengirim notifikasi ini saat ada aksi (misal: mahasiswa request pinjam -> notif ke admin).

### 3. Frontend Component (Lonceng) 🔔
- Membuat komponen Livewire `NotificationsDropdown`.
- Menambahkan ikon lonceng di header navigasi.
- Menampilkan daftar notifikasi dengan status "read/unread".
- Menambahkan fitur "Mark as Read".

Saya akan mulai dengan menyiapkan database. Apakah Anda setuju?