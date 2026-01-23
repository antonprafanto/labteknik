Untuk pengguna baru yang ingin mendaftar, saat ini sistem sudah mendukung registrasi mandiri, namun tampilannya masih bahasa Inggris dan belum meminta Nomor Induk (NIM/NIP).

Berikut adalah langkah perbaikan agar proses pendaftaran lebih sesuai:

### 1. Menambahkan Kolom NIM/NIP di Form Registrasi 📝
Saya akan menambahkan kolom input **NIM / NIP** pada halaman pendaftaran. Ini penting untuk validasi identitas mahasiswa atau dosen.

### 2. Update Logika Pendaftaran (Backend) ⚙️
Saya akan memperbarui logika di `CreateNewUser.php` untuk:
*   Memvalidasi input NIM/NIP (wajib diisi dan harus unik).
*   Menyimpan data NIM/NIP ke database.
*   Secara default, pengguna baru akan mendapatkan peran **Student (Mahasiswa)** sesuai konfigurasi database.

### 3. Menerjemahkan Halaman Registrasi ke Bahasa Indonesia 🇮🇩
Saya akan mengubah seluruh teks di halaman registrasi (Register, Name, Password, dll) menjadi Bahasa Indonesia agar konsisten dengan halaman lain yang baru saja kita ubah.

Apakah Anda setuju dengan penambahan kolom NIM dan penerjemahan ini?