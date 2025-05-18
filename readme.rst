Sistem Pembayaran TU
====================

Sistem Pembayaran TU adalah aplikasi untuk manajemen pembayaran dan laporan pembayaran pada sekolah. Aplikasi ini menggunakan PHP dengan framework CodeIgniter dan library DomPDF untuk menghasilkan laporan PDF.

Instalasi
---------

1. **Clone Repository**
   Clone repository ini ke dalam direktori lokal Anda menggunakan Git:
   
	git clone https://github.com/anagwer/pembayaranTU_CI3.git

2. **Install Dependensi**
	Gunakan Composer untuk menginstal dependensi yang diperlukan:

composer install

3. **Konfigurasi Database**
- Buka file `application/config/database.php`.
- Sesuaikan pengaturan database dengan database yang Anda gunakan.

4. **Import Database**
	Import skema database yang ada di folder `sql/` atau buat tabel yang diperlukan secara manual.

5. **Jalankan Aplikasi**
	Jalankan aplikasi di server lokal Anda:

php -S localhost:8000


Buka browser dan akses `http://localhost:8000` untuk melihat aplikasi.

Alur Sistem
-----------

1. **Login Sistem**
Pengguna dapat login menggunakan **Username** dan **Password**. 
- **Admin** dapat mengakses semua data siswa dan notifikasi.
- **Orang Tua** hanya dapat melihat data yang terkait dengan NIS mereka.

2. **Pembayaran**
Mengelola pembayaran siswa dan mencatat status pembayaran (Lunas / Belum Lunas).

3. **Laporan Pembayaran**
Admin dapat melihat laporan pembayaran berdasarkan kelas dan jenis pembayaran, sementara orang tua hanya bisa melihat pembayaran terkait dengan NIS mereka.

4. **Notifikasi**
Sistem mengirimkan notifikasi terkait pembayaran dan status lainnya yang bisa ditandai sebagai "dibaca".

Troubleshooting
---------------

- **Composer Tidak Terpasang**: Jika Composer belum terpasang, Anda bisa mengunduhnya di [https://getcomposer.org/](https://getcomposer.org/).
- **500 Internal Server Error**: Periksa kembali konfigurasi database di `application/config/database.php` dan pastikan database dapat diakses.

Terima kasih telah menggunakan Sistem Pembayaran TU!
