# Fixora - Sistem Pelaporan dan Pemantauan Perbaikan Fasilitas Kampus

Fixora adalah aplikasi berbasis web untuk membantu proses pelaporan, pengelolaan, penugasan, dan pemantauan perbaikan fasilitas kampus. Sistem ini memungkinkan pelapor membuat laporan kerusakan tanpa perlu login, sementara admin dan teknisi memiliki panel khusus untuk mengelola laporan dan memperbarui progres perbaikan.

---

## Tujuan Proyek

Tujuan utama dari Fixora adalah menyediakan sistem pelaporan fasilitas kampus yang lebih terstruktur dibandingkan pelaporan manual melalui pesan pribadi, Google Form, atau WhatsApp biasa.

Dengan sistem ini, laporan kerusakan dapat dicatat secara rapi, diverifikasi oleh admin, ditugaskan kepada teknisi, dan dipantau progresnya oleh pelapor.

---

## Aktor Sistem

### 1. Pelapor

Pelapor adalah pengguna umum seperti mahasiswa, dosen, atau staf kampus yang ingin melaporkan kerusakan fasilitas.

Pelapor dapat:

- Membuat laporan tanpa login
- Mengisi identitas pelapor
- Memilih gedung dan ruangan
- Memilih kategori kerusakan
- Mengunggah foto kerusakan
- Mendapatkan kode laporan
- Mengecek riwayat dan progres laporan
- Melihat foto progres dari teknisi
- Menghubungi layanan melalui WhatsApp dan email

### 2. Admin

Admin bertugas mengelola laporan yang masuk.

Admin dapat:

- Melihat daftar laporan kerusakan
- Memfilter laporan berdasarkan status, prioritas, dan tanggal
- Memverifikasi laporan
- Menolak laporan dengan alasan
- Menugaskan laporan kepada teknisi
- Melihat progres perbaikan teknisi
- Menutup laporan setelah perbaikan selesai
- Memberikan pesan penutupan laporan kepada pelapor

### 3. Teknisi

Teknisi bertugas menangani laporan yang telah ditugaskan oleh admin.

Teknisi dapat:

- Melihat tugas yang diberikan
- Melihat detail laporan kerusakan
- Melihat foto kerusakan dari pelapor
- Memperbarui progres perbaikan
- Mengunggah foto progres
- Menandai pekerjaan sebagai selesai

---

## Fitur Utama

### Fitur Pelapor

- Dashboard pelapor tanpa login
- Form laporan kerusakan fasilitas
- Dropdown gedung dan ruangan yang saling terhubung
- Validasi nomor telepon hanya angka dan minimal 5 digit
- Upload foto kerusakan
- Generate kode laporan
- Riwayat laporan berdasarkan kode laporan, nomor telepon, atau email
- Timeline progres perbaikan
- Foto progres teknisi terlihat di riwayat pelapor
- Pesan penutupan laporan dari admin
- Integrasi kontak layanan melalui WhatsApp dan email

### Fitur Admin

- Panel admin berbasis Filament
- Manajemen laporan kerusakan
- Filter laporan berdasarkan:
  - Status
  - Prioritas
  - Tanggal laporan
- Verifikasi laporan
- Penolakan laporan dengan alasan
- Penugasan teknisi
- Monitoring progres perbaikan
- Penutupan laporan
- Pesan penutupan laporan untuk pelapor
- Manajemen data master seperti gedung, ruangan, kategori kerusakan, teknisi, dan pengguna

### Fitur Teknisi

- Panel teknisi berbasis Filament
- Daftar tugas teknisi
- Detail laporan kerusakan
- Melihat foto kerusakan
- Update progres perbaikan
- Upload foto progres
- Tandai pekerjaan selesai

### Fitur API

Fixora juga menyediakan dukungan API untuk kebutuhan integrasi atau pengembangan lanjutan.

API dapat digunakan untuk:

- Autentikasi API
- Akses data laporan
- Akses data gedung
- Akses data ruangan
- Akses data kategori kerusakan
- Akses data teknisi
- Akses data progres perbaikan
- Integrasi dengan aplikasi mobile atau sistem eksternal

Dokumentasi API dapat diakses melalui halaman dokumentasi API yang tersedia pada sistem.

---

## Alur Sistem

```text
Pelapor membuat laporan
        ↓
Laporan masuk ke panel admin
        ↓
Admin memeriksa laporan
        ↓
Jika tidak valid, laporan ditolak dengan alasan
        ↓
Jika valid, admin menugaskan teknisi
        ↓
Teknisi mulai mengerjakan laporan
        ↓
Teknisi memperbarui progres dan mengunggah foto
        ↓
Teknisi menandai pekerjaan selesai
        ↓
Admin menutup laporan
        ↓
Pelapor melihat status, progres, foto, dan pesan penutupan laporan