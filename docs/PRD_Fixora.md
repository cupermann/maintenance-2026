# Product Requirements Document (PRD)
# FIXORA — Sistem Pelaporan, Penugasan, dan Monitoring Perbaikan Fasilitas Kampus

| Metadata | Keterangan |
|---|---|
| Nama Produk | Fixora |
| Jenis Dokumen | Product Requirements Document (PRD) |
| Sumber | Diturunkan dan dijabarkan dari *Business Requirement Document* (BRD) Fixora |
| Basis Teknologi | Laravel, Blade, Livewire, Filament v3, MariaDB |
| Platform | Website responsif (belum mencakup aplikasi mobile) |
| Status Dokumen | Draft untuk validasi tim produk & pengembang |

> **Catatan tentang dokumen ini:** PRD ini menjabarkan seluruh isi BRD menjadi kebutuhan produk yang siap dieksekusi tim pengembang — setiap fitur diuraikan menjadi *user story*, kriteria penerimaan, dan catatan UX/edge case. Bagian yang **tidak ada secara eksplisit di BRD** (persona pengguna, metrik keberhasilan, matriks traceability, roadmap MVP vs lanjutan, asumsi, dan pertanyaan terbuka) ditambahkan sebagai kelengkapan standar PRD dan **perlu divalidasi bersama stakeholder** sebelum dijadikan acuan resmi.

---

## Daftar Isi

1. Ringkasan Produk
2. Latar Belakang & Masalah
3. Tujuan Produk & Metrik Keberhasilan
4. Target Pengguna & Persona
5. Ruang Lingkup Produk
6. Alur Pengguna & Proses Bisnis
7. Model Status Laporan
8. Persyaratan Fungsional (Detail per Fitur)
9. Persyaratan Non-Fungsional
10. Model Data
11. Arsitektur Sistem
12. Matriks Traceability (Kebutuhan Bisnis → Fitur)
13. Kriteria Penerimaan Produk
14. Risiko & Mitigasi
15. Roadmap: MVP vs Pengembangan Lanjutan
16. Catatan Implementasi & Checklist Deployment
17. Asumsi & Batasan
18. Pertanyaan Terbuka
19. Glosarium
20. Lampiran

---

## 1. Ringkasan Produk

Fixora adalah sistem berbasis website untuk **pelaporan, penugasan, dan monitoring perbaikan fasilitas kampus**. Produk ini menghubungkan tiga peran utama dalam satu alur kerja tunggal:

- **Pelapor** (mahasiswa, dosen, staf, atau civitas kampus lain) melaporkan kerusakan fasilitas tanpa perlu membuat akun.
- **Admin** (petugas sarana prasarana) memverifikasi laporan, menugaskan teknisi, memantau progres, dan menutup laporan.
- **Teknisi** mengerjakan perbaikan di lapangan dan mendokumentasikan progres dengan catatan serta foto.

Value proposition inti Fixora adalah **kecepatan pelaporan tanpa hambatan login** di sisi pelapor, dikombinasikan dengan **struktur kerja yang terkontrol** (verifikasi, penugasan, dokumentasi progres berfoto) di sisi admin dan teknisi — sehingga laporan kerusakan fasilitas tidak lagi tercecer di berbagai kanal komunikasi informal seperti WhatsApp atau percakapan langsung.

---

## 2. Latar Belakang & Masalah

### 2.1 Konteks

Fasilitas kampus (ruang kelas, toilet, lampu, AC, kursi, meja, pintu, jaringan internet, dan sarana pendukung lain) memerlukan pengelolaan yang baik agar kegiatan akademik berjalan lancar. Saat ini, laporan kerusakan umumnya disampaikan secara manual melalui WhatsApp, percakapan langsung, atau formulir sederhana.

### 2.2 Masalah yang Dihadapi

| # | Masalah | Dampak |
|---|---|---|
| 1 | Data laporan tersebar di banyak media komunikasi | Sulit dikonsolidasi, rawan hilang |
| 2 | Admin sulit memantau laporan secara terpusat dan per periode tanggal | Tidak ada gambaran beban kerja yang jelas |
| 3 | Pelapor harus bertanya langsung ke admin untuk cek status | Beban komunikasi berulang, tidak efisien |
| 4 | Teknisi tidak punya daftar tugas & dokumentasi progres yang rapi | Pekerjaan tidak terlacak, sulit diaudit |
| 5 | Bukti foto (kerusakan, progres, hasil) tidak terdokumentasi dalam satu alur | Tidak ada jejak bukti perbaikan |
| 6 | Tidak ada verifikasi terhadap laporan palsu/tidak jelas | Risiko penugasan teknisi yang sia-sia |
| 7 | Pelapor kesulitan mengakses kontak layanan saat mengalami kendala | Pengalaman pengguna buruk saat troubleshooting |

### 2.3 Solusi Produk

Fixora menjawab ketujuh masalah di atas melalui: website pelapor tanpa login, form laporan wajib dengan foto, dashboard admin dengan verifikasi/filter/penugasan/penutupan, dashboard teknisi dengan update progres berfoto, riwayat laporan yang transparan bagi pelapor, serta kartu kontak WhatsApp/email langsung di dashboard pelapor.

---

## 3. Tujuan Produk & Metrik Keberhasilan

### 3.1 Tujuan Bisnis

- Mempermudah civitas kampus melaporkan kerusakan fasilitas tanpa proses login yang panjang.
- Meningkatkan ketertiban data laporan kerusakan fasilitas kampus.
- Membantu admin melakukan verifikasi, penolakan, penugasan, pemantauan, dan penutupan laporan secara terstruktur.
- Membantu teknisi mengetahui tugas yang diberikan dan mendokumentasikan progres pekerjaan dengan foto.
- Memberikan transparansi kepada pelapor melalui riwayat status, foto progres, dan pesan penutupan laporan.
- Mempermudah pelapor menghubungi layanan kampus melalui WhatsApp dan email jika mengalami kendala.
- Menyediakan data historis laporan sebagai dasar evaluasi kondisi fasilitas kampus.

### 3.2 Metrik Keberhasilan (usulan — perlu disepakati stakeholder)

| Metrik | Definisi | Target Awal (usulan) |
|---|---|---|
| Waktu verifikasi laporan | Rentang waktu dari status *Diajukan* ke *Diverifikasi*/*Ditolak* | ≤ 1×24 jam kerja |
| Waktu penugasan teknisi | Rentang waktu dari *Diverifikasi* ke *Ditugaskan* | ≤ 1×24 jam kerja |
| Waktu penyelesaian laporan | Rentang waktu dari *Ditugaskan* ke *Selesai* | Bervariasi per prioritas, dipantau per kategori |
| Tingkat kelengkapan progres | % laporan *Diproses* yang memiliki minimal 1 update progres berfoto | 100% |
| Tingkat penolakan laporan | % laporan berstatus *Ditolak* dari total laporan masuk | Dipantau sebagai indikator kualitas laporan pelapor |
| Penggunaan riwayat laporan | % pelapor yang kembali mengecek riwayat menggunakan kode laporan | Indikator adopsi fitur transparansi |
| Penggunaan kartu kontak | Jumlah klik kartu WhatsApp/email dari dashboard pelapor | Indikator kebutuhan bantuan manual |

---

## 4. Target Pengguna & Persona

### 4.1 Persona: Pelapor — "Rani, Mahasiswa Semester 4"

- **Tujuan:** Melaporkan AC ruang kelas yang mati secepat mungkin tanpa perlu daftar akun.
- **Titik sakit (pain point):** Malas mengisi form panjang; tidak tahu harus menghubungi siapa; tidak tahu status laporan setelah dikirim.
- **Kebutuhan kunci:** Form singkat, upload foto mudah, kode laporan yang bisa dicek kembali, akses cepat ke kontak layanan.
- **Perangkat:** Mayoritas mengakses dari smartphone.

### 4.2 Persona: Admin — "Pak Dedi, Petugas Sarana Prasarana"

- **Tujuan:** Memastikan hanya laporan valid yang diteruskan ke teknisi, dan pekerjaan teknisi termonitor.
- **Titik sakit:** Laporan masuk dari banyak kanal berbeda; sulit melihat laporan mana yang sudah lama belum ditangani.
- **Kebutuhan kunci:** Daftar laporan yang bisa difilter (status, prioritas, tanggal), kemampuan menolak dengan alasan, penugasan teknisi yang jelas, riwayat progres yang mudah dipantau.
- **Perangkat:** Umumnya laptop/desktop di ruang kerja.

### 4.3 Persona: Teknisi — "Bang Yusuf, Petugas Maintenance Lapangan"

- **Tujuan:** Mengetahui tugas hari ini dan mendokumentasikan pekerjaannya dengan cepat dari lapangan.
- **Titik sakit:** Tugas disampaikan lisan/WhatsApp tanpa detail lokasi yang jelas; tidak ada bukti dokumentasi pekerjaan.
- **Kebutuhan kunci:** Daftar tugas yang ringkas, detail lokasi & deskripsi kerusakan, upload foto progres dari HP dengan cepat.
- **Perangkat:** Mayoritas mengakses dari smartphone saat di lapangan.

---

## 5. Ruang Lingkup Produk

### 5.1 Termasuk dalam Ruang Lingkup

**Website Pelapor**
- Dashboard pelapor tanpa login.
- Form laporan kerusakan (identitas, kontak, lokasi, kategori, deskripsi, prioritas, foto).
- Validasi nomor telepon sebagai string angka (minimal 5 digit, mempertahankan angka 0 di depan).
- Dropdown ruangan yang menyesuaikan gedung terpilih.
- Kode permintaan otomatis sebagai identitas laporan.
- Pengecekan riwayat laporan via kode laporan/nomor telepon/email.
- Kartu kontak WhatsApp dan email layanan kampus.

**Dashboard Admin**
- Login/logout panel admin.
- Daftar & detail laporan masuk beserta foto kerusakan.
- Filter laporan berdasarkan status, prioritas, dan rentang tanggal.
- Verifikasi laporan valid / penolakan laporan tidak valid dengan alasan.
- Penugasan teknisi.
- Pemantauan progres pekerjaan teknisi.
- Penutupan laporan dengan pesan penutupan; aksi berubah menjadi *Selesai* setelah ditutup.
- Pengelolaan data master (gedung, ruangan, kategori kerusakan, teknisi, pengguna).

**Dashboard Teknisi**
- Login/logout panel teknisi.
- Daftar tugas yang diberikan admin.
- Detail lokasi, deskripsi kerusakan, prioritas, foto kerusakan, catatan penugasan.
- Mulai pengerjaan dengan catatan & foto progres.
- Penandaan pekerjaan selesai dengan catatan hasil & foto hasil perbaikan.

**Pengelolaan Laporan**
- Penyimpanan data laporan, foto kerusakan, dan foto hasil perbaikan.
- Pengelolaan & riwayat perubahan status laporan.
- Riwayat penugasan teknisi dan catatan proses perbaikan.

**Integrasi Kontak Layanan**
- Kartu WhatsApp dan email pada dashboard pelapor yang membuka aplikasi terkait dengan pesan awal (tautan statis, **bukan** notifikasi otomatis atau gateway pesan).

### 5.2 Tidak Termasuk dalam Ruang Lingkup (Out of Scope)

- Notifikasi otomatis melalui WhatsApp gateway, email gateway, atau SMS gateway.
- Aplikasi mobile Android/iOS native.
- Integrasi pembayaran online.
- Integrasi penuh dengan sistem akademik kampus atau SSO kampus.
- Sistem inventaris aset kampus secara lengkap.
- Pengelolaan anggaran pembelian alat dan suku cadang secara rinci.
- Fitur OTP, CAPTCHA, dan QR Code ruangan pada versi deploy awal.

---

## 6. Alur Pengguna & Proses Bisnis

Alur utama proses pelaporan hingga penutupan laporan (lihat juga diagram alur pada Lampiran, Gambar 1):

1. Pelapor membuka dashboard pelapor Fixora (tanpa login).
2. Pelapor memilih menu **Buat Laporan** dan mengisi form laporan.
3. Sistem memvalidasi data: nomor telepon (angka, minimal 5 digit), lokasi (gedung → ruangan), kategori, deskripsi, prioritas, dan foto kerusakan (wajib).
4. Sistem menyimpan laporan dengan status **Diajukan** dan membuat kode permintaan unik.
5. Admin memeriksa laporan masuk melalui panel admin.
6. **Jika tidak valid:** admin menolak laporan dan mengisi alasan penolakan → status **Ditolak**.
7. **Jika valid:** admin memverifikasi laporan → status **Diverifikasi**, lalu menugaskan teknisi → status **Ditugaskan**.
8. Teknisi melihat tugas, memulai pekerjaan, menulis catatan progres, dan mengunggah foto progres → status **Diproses**.
9. Teknisi menandai pekerjaan selesai dengan catatan hasil dan foto hasil perbaikan → status **Selesai** (sisi teknisi).
10. Admin menutup laporan dan mengisi pesan penutupan → aksi admin berubah menjadi **Selesai** (final, tidak bisa ditutup berulang).
11. Pelapor dapat mengecek riwayat laporan kapan saja menggunakan kode laporan, nomor telepon, atau email untuk melihat status, foto progres, alasan penolakan, atau pesan penutupan.

---

## 7. Model Status Laporan

| Status | Makna | Pengubah Status |
|---|---|---|
| **Diajukan** | Status awal setelah pelapor berhasil mengirim laporan | Pelapor / Sistem |
| **Diverifikasi** | Laporan dinilai valid oleh admin dan siap ditugaskan | Admin |
| **Ditolak** | Laporan tidak dapat diproses (tidak valid/tidak jelas/di luar ruang lingkup); alasan tampil di riwayat pelapor | Admin |
| **Ditugaskan** | Admin sudah memilih teknisi untuk menangani laporan | Admin |
| **Diproses** | Teknisi mulai mengerjakan laporan dan mengirim update progres | Teknisi |
| **Selesai** | Teknisi menyelesaikan pekerjaan; admin dapat menutup laporan dengan pesan penutupan. Status akhir tetap *Selesai* | Teknisi & Admin |

Diagram alur status (lihat juga Gambar 2 pada Lampiran):

```
Diajukan ──► Diverifikasi ──► Ditugaskan ──► Diproses ──► Selesai
    │
    └──► Ditolak
```

**Aturan penting:** setelah status mencapai *Selesai* dan ditutup admin, aksi pada panel admin berubah menjadi label *Selesai* (bukan tombol aktif lagi) — laporan **tidak dapat ditutup berulang kali**.

---

## 8. Persyaratan Fungsional (Detail per Fitur)

Setiap kebutuhan fungsional dari BRD dijabarkan menjadi *user story* dan kriteria penerimaan yang siap dieksekusi.

### 8.1 Modul Pelapor

#### FR-P-01 — Dashboard Pelapor
**User Story:** Sebagai pelapor, saya ingin membuka halaman awal yang jelas agar saya tahu cara melapor, mengecek riwayat, dan menghubungi layanan.
**Kriteria Penerimaan:**
- Halaman menampilkan ringkasan layanan, menu *Buat Laporan*, menu *Riwayat Laporan*, panduan singkat, dan kartu kontak layanan.
- Halaman dapat diakses tanpa login dan tanpa registrasi akun.

#### FR-P-02 — Buat Laporan Tanpa Login
**User Story:** Sebagai pelapor, saya ingin mengirim laporan kerusakan tanpa membuat akun agar prosesnya cepat.
**Kriteria Penerimaan:**
- Form laporan dapat diisi dan dikirim tanpa proses autentikasi apa pun.
- Field wajib: nama, nomor telepon, gedung, ruangan, kategori kerusakan, judul, deskripsi, prioritas, foto kerusakan. Email bersifat opsional.

#### FR-P-03 — Validasi Nomor Telepon
**User Story:** Sebagai sistem, saya perlu memastikan nomor telepon pelapor valid agar admin/teknisi dapat menghubungi pelapor bila diperlukan.
**Kriteria Penerimaan:**
- Input hanya menerima karakter angka.
- Panjang minimal 5 digit, maksimal sesuai konfigurasi sistem.
- Nomor disimpan sebagai tipe data **string** (bukan integer) di database agar angka 0 di depan (mis. `0812...`) tidak hilang.
- Sistem menampilkan pesan kesalahan yang jelas jika format tidak sesuai.

#### FR-P-04 — Dropdown Gedung dan Ruangan Berjenjang
**User Story:** Sebagai pelapor, saya ingin memilih ruangan yang sesuai dengan gedung agar lokasi laporan saya akurat.
**Kriteria Penerimaan:**
- Dropdown ruangan kosong/nonaktif sebelum gedung dipilih.
- Setelah gedung dipilih, dropdown ruangan hanya menampilkan ruangan yang terhubung ke gedung tersebut (relasi `ruangans.gedung_id`).

#### FR-P-05 — Foto Kerusakan Wajib
**User Story:** Sebagai pelapor, saya ingin melampirkan foto kerusakan agar admin dan teknisi memahami kondisi sebenarnya.
**Kriteria Penerimaan:**
- Form tidak dapat dikirim tanpa minimal satu foto kerusakan.
- Sistem membatasi format file (mis. JPG/PNG) dan ukuran maksimum file, dengan pesan kesalahan yang jelas bila melanggar batas.

#### FR-P-06 — Kode Laporan Otomatis
**User Story:** Sebagai pelapor, saya ingin menerima kode unik setelah melapor agar saya bisa mengecek statusnya nanti.
**Kriteria Penerimaan:**
- Sistem membuat kode permintaan unik segera setelah laporan berhasil disimpan.
- Kode ditampilkan ke pelapor di layar konfirmasi setelah pengiriman berhasil.

#### FR-P-07 — Cek Riwayat Laporan
**User Story:** Sebagai pelapor, saya ingin mencari laporan saya menggunakan kode, nomor telepon, atau email agar saya tidak perlu login.
**Kriteria Penerimaan:**
- Pencarian berhasil dengan salah satu dari tiga identifier: kode permintaan, nomor telepon, atau email.
- Sistem menampilkan pesan yang sesuai jika data pencarian tidak ditemukan.

#### FR-P-08 — Riwayat Foto Progres
**User Story:** Sebagai pelapor, saya ingin melihat foto progres pekerjaan teknisi agar saya yakin laporan saya ditangani.
**Kriteria Penerimaan:**
- Semua foto progres yang diunggah teknisi tampil secara kronologis pada halaman riwayat laporan terkait.

#### FR-P-09 — Pesan Penutupan Admin
**User Story:** Sebagai pelapor, saya ingin membaca pesan penutupan dari admin agar saya tahu laporan saya benar-benar selesai.
**Kriteria Penerimaan:**
- Setelah admin menutup laporan, pesan penutupan tampil pada halaman riwayat pelapor bersama status *Selesai*.

#### FR-P-10 — Kontak WhatsApp dan Email
**User Story:** Sebagai pelapor, saya ingin langsung menghubungi layanan sarpras jika mengalami kendala penggunaan sistem.
**Kriteria Penerimaan:**
- Kartu WhatsApp membuka aplikasi/situs WhatsApp dengan nomor layanan dan pesan awal terisi otomatis.
- Kartu email membuka aplikasi email default dengan alamat tujuan dan subjek/pesan awal terisi otomatis (`mailto:`).
- Jika aplikasi terkait gagal terbuka (mis. di desktop tanpa aplikasi WhatsApp), alamat email dan nomor kontak tetap ditampilkan sebagai teks agar bisa dihubungi manual.

### 8.2 Modul Admin

#### FR-A-01 — Login Admin
**User Story:** Sebagai admin, saya perlu login agar hanya petugas berwenang yang dapat mengakses data laporan.
**Kriteria Penerimaan:** Panel admin tidak dapat diakses tanpa autentikasi yang valid; sesi logout mengakhiri akses.

#### FR-A-02 — Daftar Laporan
**User Story:** Sebagai admin, saya ingin melihat seluruh laporan masuk dalam satu tampilan agar saya bisa memantau beban kerja.
**Kriteria Penerimaan:** Daftar menampilkan minimal kode laporan, status, prioritas, lokasi, dan tanggal laporan.

#### FR-A-03 — Detail Laporan
**User Story:** Sebagai admin, saya ingin melihat detail lengkap laporan sebelum memutuskan verifikasi atau penolakan.
**Kriteria Penerimaan:** Halaman detail menampilkan seluruh data laporan termasuk foto kerusakan, lokasi, kategori, deskripsi, dan prioritas.

#### FR-A-04 — Filter Laporan
**User Story:** Sebagai admin, saya ingin menyaring laporan berdasarkan status, prioritas, dan rentang tanggal agar saya fokus pada laporan yang relevan.
**Kriteria Penerimaan:**
- Filter dapat dikombinasikan (status + prioritas + rentang tanggal sekaligus).
- Hasil filter dapat direset ke tampilan semua laporan.

#### FR-A-05 — Tolak Laporan
**User Story:** Sebagai admin, saya ingin menolak laporan yang tidak valid dengan alasan agar pelapor memahami keputusan tersebut.
**Kriteria Penerimaan:**
- Alasan penolakan wajib diisi sebelum status berubah menjadi *Ditolak*.
- Alasan penolakan tampil pada riwayat laporan pelapor.

#### FR-A-06 — Assign Teknisi
**User Story:** Sebagai admin, saya ingin menugaskan teknisi tertentu pada laporan valid agar pekerjaan segera ditangani.
**Kriteria Penerimaan:**
- Penugasan hanya dapat dilakukan pada laporan berstatus *Diverifikasi*.
- Sistem mencatat teknisi, admin penugas, dan tanggal penugasan pada tabel `penugasan_teknisis`.

#### FR-A-07 — Pantau Progres
**User Story:** Sebagai admin, saya ingin melihat catatan dan foto progres teknisi agar saya dapat memastikan pekerjaan berjalan.
**Kriteria Penerimaan:** Seluruh entri `progres_perbaikans` terkait laporan tampil kronologis pada halaman detail laporan admin.

#### FR-A-08 — Tutup Laporan
**User Story:** Sebagai admin, saya ingin menutup laporan yang sudah selesai dikerjakan dengan pesan penutupan agar alur laporan tuntas secara formal.
**Kriteria Penerimaan:**
- Penutupan hanya dapat dilakukan setelah teknisi menandai pekerjaan selesai.
- Pesan penutupan wajib diisi dan tersimpan, serta tampil di riwayat pelapor (lihat FR-P-09).

#### FR-A-09 — Aksi "Selesai" Setelah Ditutup
**User Story:** Sebagai admin, saya ingin melihat status akhir yang jelas agar saya tidak menutup laporan yang sama berulang kali.
**Kriteria Penerimaan:** Setelah laporan ditutup, tombol aksi pada daftar/detail laporan berubah menjadi label non-aktif **Selesai**.

#### FR-A-10 — Data Master
**User Story:** Sebagai admin, saya ingin mengelola data gedung, ruangan, kategori kerusakan, teknisi, dan pengguna agar data pendukung sistem selalu akurat.
**Kriteria Penerimaan:**
- CRUD (tambah/ubah/nonaktifkan) tersedia untuk kelima entitas data master sesuai hak akses.
- Perubahan gedung/ruangan langsung memengaruhi dropdown di form pelapor (FR-P-04).

### 8.3 Modul Teknisi

#### FR-T-01 — Login Teknisi
**User Story:** Sebagai teknisi, saya perlu login agar hanya saya yang dapat memperbarui tugas yang ditugaskan kepada saya.
**Kriteria Penerimaan:** Panel teknisi tidak dapat diakses tanpa autentikasi yang valid.

#### FR-T-02 — Tugas Saya
**User Story:** Sebagai teknisi, saya ingin melihat daftar tugas yang diberikan admin agar saya tahu prioritas pekerjaan hari ini.
**Kriteria Penerimaan:** Daftar tugas hanya menampilkan laporan yang ditugaskan kepada teknisi yang sedang login.

#### FR-T-03 — Detail Tugas
**User Story:** Sebagai teknisi, saya ingin melihat lokasi, deskripsi kerusakan, prioritas, foto, dan catatan penugasan sebelum berangkat ke lokasi.
**Kriteria Penerimaan:** Halaman detail tugas menampilkan seluruh informasi terkait laporan dan penugasan.

#### FR-T-04 — Mulai Dikerjakan
**User Story:** Sebagai teknisi, saya ingin menandai bahwa saya mulai mengerjakan laporan dan melampirkan catatan serta foto progres.
**Kriteria Penerimaan:**
- Status laporan berubah menjadi *Diproses* saat teknisi mengirim update progres pertama.
- Catatan progres dan foto progres wajib diisi setiap update.

#### FR-T-05 — Tandai Selesai
**User Story:** Sebagai teknisi, saya ingin menandai pekerjaan selesai dengan catatan hasil dan foto hasil perbaikan sebagai bukti penyelesaian.
**Kriteria Penerimaan:**
- Status berubah menjadi *Selesai* setelah teknisi mengisi catatan hasil dan mengunggah foto hasil perbaikan.
- Setelah status *Selesai*, teknisi tidak dapat lagi mengubah data progres laporan tersebut.

#### FR-T-06 — Riwayat Progres
**User Story:** Sebagai teknisi (dan admin/pelapor), saya ingin setiap update tersimpan sebagai riwayat agar pekerjaan dapat ditelusuri.
**Kriteria Penerimaan:** Setiap entri progres tersimpan permanen di tabel `progres_perbaikans` dan tampil di panel admin serta riwayat pelapor.

### 8.4 Modul Data & Produksi

#### FR-D-01 — Data Master Produksi
**Kriteria Penerimaan:** Seeder produksi hanya membawa akun admin, akun teknisi, gedung, ruangan, dan kategori kerusakan — tidak ada data transaksional.

#### FR-D-02 — Data Dummy Tidak Ikut Deploy
**Kriteria Penerimaan:** Seeder data dummy (laporan, penugasan, progres, foto contoh) tidak dipanggil pada proses deploy produksi; hanya digunakan pada environment lokal/staging.

#### FR-D-03 — Penyimpanan Foto
**Kriteria Penerimaan:** Foto kerusakan dan foto progres disimpan pada storage aplikasi dan dapat diakses melalui tautan publik yang aman (memerlukan `storage:link` aktif — lihat Bagian 16).

---

## 9. Persyaratan Non-Fungsional

| Aspek | Kebutuhan | Catatan Implementasi |
|---|---|---|
| **Keamanan** | Admin dan teknisi wajib login; akses panel dibatasi berdasarkan role; pelapor hanya dapat mengirim/mencari laporan menggunakan data yang ia masukkan sendiri | Terapkan role-based access control (RBAC) pada Filament v3 |
| **Kemudahan Penggunaan** | Tampilan pelapor sederhana, responsif, dapat digunakan tanpa login | Prioritaskan desain mobile-first karena mayoritas pelapor mengakses via smartphone |
| **Reliabilitas** | Data laporan, status, catatan, dan foto tersimpan dengan baik pada database dan storage | Perlu strategi backup database & storage secara berkala |
| **Kinerja** | Daftar laporan, pencarian riwayat, dan filter admin harus responsif dengan waktu respon wajar | Pertimbangkan indexing pada kolom status, prioritas, dan tanggal laporan |
| **Kompatibilitas** | Dapat diakses melalui browser modern pada laptop dan smartphone | Uji lintas browser (Chrome, Safari, Edge) dan perangkat |
| **Auditabilitas** | Status laporan, penugasan, progres, catatan teknisi, alasan penolakan, dan pesan penutupan dapat ditelusuri | Simpan histori perubahan status sebagai log, bukan hanya field status terkini |
| **Maintainability** | Data master dapat diperbarui melalui panel admin tanpa mengubah kode program | Semua entitas master (gedung, ruangan, kategori) dikelola via Filament resource |
| **Production Readiness** | Data dummy tidak dipanggil pada seeder produksi; konfigurasi storage aktif sebelum go-live | Lihat checklist deployment di Bagian 16 |

---

## 10. Model Data

| Tabel | Atribut Utama | Fungsi |
|---|---|---|
| `users` | id, name, email, password, phone, role, timestamps | Akun admin, teknisi, dan pengguna internal dengan akses login |
| `gedungs` | id, nama_gedung, kode_gedung, deskripsi, status, timestamps | Data master gedung kampus |
| `ruangans` | id, gedung_id, kode_ruangan, nama_ruangan, lantai, status, timestamps | Data ruangan, terhubung ke gedung (relasi *belongs to*) |
| `kategori_kerusakans` | id, nama_kategori, deskripsi, status, timestamps | Data kategori kerusakan fasilitas |
| `teknisis` | id, user_id, kode_teknisi, nama_teknisi, no_telepon, keahlian, status, alamat, timestamps | Profil teknisi, terhubung ke akun `users` |
| `permintaan_maintenances` | id, kode_permintaan, user_id, nama_pelapor, email_pelapor, no_telepon_pelapor, ruangan_id, kategori_kerusakan_id, judul, deskripsi, prioritas, foto_kerusakan, status, catatan_admin, tanggal_laporan, tanggal_verifikasi, tanggal_selesai, timestamps | Data inti laporan kerusakan. `no_telepon_pelapor` **wajib bertipe string** |
| `penugasan_teknisis` | id, permintaan_maintenance_id, teknisi_id, admin_id, tanggal_penugasan, catatan_penugasan, timestamps | Data penugasan teknisi oleh admin |
| `progres_perbaikans` | id, permintaan_maintenance_id, teknisi_id, status_progres, deskripsi_progres, foto_progres, tanggal_progres, timestamps | Riwayat progres pekerjaan teknisi beserta foto bukti |

**Relasi kunci:**
- `ruangans.gedung_id → gedungs.id` (satu gedung memiliki banyak ruangan; mendasari FR-P-04).
- `permintaan_maintenances.ruangan_id → ruangans.id` dan `.kategori_kerusakan_id → kategori_kerusakans.id`.
- `penugasan_teknisis.permintaan_maintenance_id → permintaan_maintenances.id`, `.teknisi_id → teknisis.id`.
- `progres_perbaikans.permintaan_maintenance_id → permintaan_maintenances.id` (satu laporan memiliki banyak entri progres — mendasari FR-P-08 dan FR-T-06).

---

## 11. Arsitektur Sistem

Fixora dibangun di atas arsitektur aplikasi web berbasis Laravel dengan pemisahan tampilan antara pelapor (publik, tanpa login) dan panel internal (admin/teknisi, berbasis role).

| Komponen | Teknologi | Fungsi |
|---|---|---|
| Frontend Pelapor | Blade + Livewire | Dashboard pelapor, form laporan, riwayat laporan, panduan, kontak layanan |
| Panel Admin | Filament v3 | Mengelola laporan, verifikasi, penugasan, filter, data master, penutupan laporan |
| Panel Teknisi | Filament v3 | Menampilkan tugas, update progres dengan foto |
| Back-end | Laravel | Validasi, penyimpanan data, relasi model, file upload, proses bisnis |
| Database | MariaDB | Menyimpan data pengguna, gedung, ruangan, kategori, laporan, penugasan, progres |
| Penyimpanan File | Laravel storage | Foto kerusakan dan foto progres teknisi |
| Server & Deploy | Docker, Nginx, GitHub, VPS | Menjalankan aplikasi pada lingkungan produksi |
| Kontak Layanan | Tautan WhatsApp (`wa.me`) dan `mailto:` | Membuka aplikasi komunikasi langsung dari dashboard pelapor |

---

## 12. Matriks Traceability (Kebutuhan Bisnis → Fitur)

| Kode Kebutuhan Bisnis | Kebutuhan Bisnis | Fitur Terkait |
|---|---|---|
| KB-01 | Kemudahan pelaporan | FR-P-01, FR-P-02, FR-P-06 |
| KB-02 | Validasi laporan | FR-P-03, FR-P-05 |
| KB-03 | Ketepatan lokasi | FR-P-04 |
| KB-04 | Monitoring admin | FR-A-02, FR-A-03, FR-A-04 |
| KB-05 | Dokumentasi teknisi | FR-T-04, FR-T-05, FR-T-06 |
| KB-06 | Transparansi pelapor | FR-P-07, FR-P-08, FR-P-09 |
| KB-07 | Kontak layanan | FR-P-10 |

---

## 13. Kriteria Penerimaan Produk

Produk dianggap siap rilis (MVP) apabila seluruh poin berikut terpenuhi:

- [ ] Pelapor dapat membuka dashboard pelapor tanpa login.
- [ ] Pelapor dapat membuat laporan dengan data lengkap dan foto kerusakan wajib.
- [ ] Nomor telepon hanya menerima angka, minimal 5 digit, dan angka 0 di depan tetap tersimpan.
- [ ] Ruangan yang muncul sesuai dengan gedung yang dipilih.
- [ ] Sistem membuat kode permintaan setelah laporan berhasil dikirim.
- [ ] Pelapor dapat mengecek riwayat menggunakan kode laporan, nomor telepon, atau email.
- [ ] Riwayat pelapor menampilkan status, detail lokasi, teknisi, catatan progres, dan foto update teknisi.
- [ ] Riwayat pelapor menampilkan alasan penolakan jika laporan ditolak admin.
- [ ] Riwayat pelapor menampilkan pesan penutupan jika laporan sudah ditutup admin.
- [ ] Kartu kontak WhatsApp membuka percakapan WhatsApp dengan nomor layanan.
- [ ] Kartu email membuka aplikasi email dengan alamat layanan dan pesan awal.
- [ ] Admin dapat memfilter laporan berdasarkan status, prioritas, dan rentang tanggal.
- [ ] Admin dapat menolak laporan, menugaskan teknisi, dan menutup laporan.
- [ ] Setelah laporan ditutup, aksi admin berubah menjadi *Selesai*.
- [ ] Teknisi dapat mengunggah foto progres dan foto hasil perbaikan.
- [ ] Data dummy tidak ikut digunakan pada deploy produksi.

---

## 14. Risiko & Mitigasi

| Risiko | Mitigasi | Tingkat Dampak* |
|---|---|---|
| Laporan palsu atau tidak valid | Admin melakukan verifikasi dan dapat menolak laporan dengan alasan yang terlihat di riwayat pelapor | Sedang |
| Nomor telepon tidak valid | Input dibatasi angka, minimal 5 digit, disimpan sebagai string agar angka 0 di depan tidak hilang | Rendah |
| Foto terlalu besar atau format tidak sesuai | Sistem membatasi format dan ukuran file gambar | Rendah |
| Lokasi laporan tidak tepat | Pilihan ruangan bergantung pada gedung yang dipilih | Rendah |
| Teknisi tidak memperbarui progres | Aksi progres dibuat sebagai bagian wajib alur kerja teknisi dan dapat dipantau admin | Sedang |
| Pelapor tidak mengetahui hasil akhir | Riwayat laporan menampilkan status, foto progres, dan pesan penutupan admin | Rendah |
| Tautan WhatsApp/email tidak membuka aplikasi | Sistem tetap menampilkan alamat email dan nomor kontak agar dapat dihubungi manual | Rendah |
| Foto tidak tampil setelah deploy | Jalankan `storage:link` dan pastikan permission folder storage serta public benar | Sedang–Tinggi |
| Hak akses admin dan teknisi bercampur | Role pengguna dan panel akses dikonfigurasi agar admin/teknisi hanya mengakses fungsi sesuai perannya | Tinggi |

\* *Tingkat dampak merupakan penilaian tambahan untuk membantu prioritisasi QA dan belum tercantum di BRD asli — sebaiknya dikonfirmasi ulang oleh tim.*

---

## 15. Roadmap: MVP vs Pengembangan Lanjutan

### 15.1 MVP (Ruang Lingkup Saat Ini)
Seluruh fitur pada Bagian 5.1 dan 8 di atas — pelaporan tanpa login, verifikasi/penugasan/penutupan admin, update progres teknisi, riwayat transparan, dan kartu kontak layanan.

### 15.2 Fase Lanjutan (Backlog, belum diprioritaskan)

| Usulan Fitur | Tujuan | Kaitan dengan Risiko/Batasan MVP |
|---|---|---|
| CAPTCHA pada form laporan | Mengurangi risiko spam karena pelapor tidak login | Melengkapi Bagian 4.6 (out of scope MVP) |
| OTP nomor telepon/email | Memvalidasi identitas pelapor | Melengkapi Bagian 4.6 |
| QR Code ruangan | Form otomatis terisi gedung & ruangan saat discan | Mempercepat FR-P-04 |
| Notifikasi otomatis WhatsApp/email | Update status ke admin, teknisi, dan pelapor otomatis | Mengurangi ketergantungan pengecekan manual riwayat (FR-P-07) |
| Dashboard statistik admin lanjutan | Grafik laporan per bulan, per gedung, per kategori | Mendukung evaluasi kondisi fasilitas (Tujuan Bisnis ke-7) |
| Export laporan (Excel/PDF) | Kebutuhan rekap dan audit | Mendukung Auditabilitas (Bagian 9) |
| SLA waktu pengerjaan | Mengukur ketepatan respons perbaikan | Mendukung metrik keberhasilan (Bagian 3.2) |
| Integrasi SSO kampus | Jika pelapor diwajibkan menggunakan akun kampus | Perubahan besar pada model "tanpa login" — perlu kajian ulang |

---

## 16. Catatan Implementasi & Checklist Deployment

- [ ] File seeder produksi hanya memanggil data master yang diperlukan (akun admin, akun teknisi, gedung, ruangan, kategori kerusakan, data teknisi).
- [ ] Seeder dummy (laporan, penugasan, progres, foto contoh) hanya dipanggil di environment local.
- [ ] Kolom `no_telepon_pelapor` bertipe **string** agar nomor seperti `0812...` tidak kehilangan angka 0 di depan.
- [ ] `storage:link` aktif agar foto kerusakan dan foto progres tampil di admin, teknisi, dan riwayat pelapor.
- [ ] Nomor WhatsApp dashboard menggunakan format internasional tanpa `+`, spasi, atau tanda hubung, dan tanpa angka 0 di depan (contoh: `628111111111`).
- [ ] Alamat email kontak layanan sudah sesuai dengan alamat resmi kampus/bagian sarana prasarana.
- [ ] Konfigurasi `APP_NAME`, domain, dan panel admin/teknisi sudah sesuai sebelum go-live.
- [ ] Uji alur end-to-end: pelapor → admin → teknisi → pelapor mengecek riwayat kembali.

---

## 17. Asumsi & Batasan

*(Bagian ini merupakan tambahan PRD dan perlu divalidasi bersama stakeholder.)*

- Diasumsikan satu laporan hanya dapat ditugaskan ke **satu** teknisi dalam satu waktu (tidak ada penugasan tim/multi-teknisi pada MVP).
- Diasumsikan prioritas laporan (mis. rendah/sedang/tinggi/darurat) ditentukan oleh pelapor saat membuat laporan, tanpa validasi otomatis dari sistem — admin dapat mengoreksi bila diperlukan.
- Belum ada mekanisme pembatasan jumlah laporan yang dapat dikirim oleh satu nomor telepon/email dalam periode tertentu (berkaitan dengan risiko laporan palsu, lihat Bagian 14).
- Belum ada SLA (Service Level Agreement) baku untuk waktu verifikasi maupun penyelesaian laporan pada versi awal — usulan metrik pada Bagian 3.2 sifatnya awal.
- Karena tidak ada login pelapor, satu-satunya cara pelapor mengecek riwayat adalah dengan menyimpan kode laporan/menggunakan nomor telepon atau email yang sama — pelapor yang lupa/salah input berisiko kehilangan akses ke riwayatnya.

---

## 18. Pertanyaan Terbuka

*(Bagian ini merupakan tambahan PRD untuk diklarifikasi sebelum atau selama pengembangan.)*

1. Apakah diperlukan batas jumlah laporan aktif per nomor telepon/email untuk mencegah spam sebelum CAPTCHA/OTP tersedia di fase lanjutan?
2. Apakah admin memerlukan sub-role (mis. admin gedung tertentu) atau seluruh admin memiliki akses penuh ke semua laporan?
3. Bagaimana penanganan bila teknisi yang ditugaskan berhalangan — apakah admin dapat menugaskan ulang (*re-assign*) laporan yang sudah *Ditugaskan*/*Diproses*?
4. Apakah kategori prioritas memiliki definisi baku (mis. kriteria "darurat") yang perlu ditampilkan sebagai panduan ke pelapor saat mengisi form?
5. Berapa batas ukuran dan jumlah maksimum foto per laporan/per update progres?

---

## 19. Glosarium

| Istilah | Definisi |
|---|---|
| **Pelapor** | Mahasiswa, dosen, staf, atau civitas kampus yang melaporkan kerusakan fasilitas |
| **Admin** | Petugas sarana prasarana yang mengelola verifikasi, penugasan, dan penutupan laporan |
| **Teknisi** | Petugas maintenance lapangan yang menangani perbaikan |
| **Kode Permintaan** | Kode unik yang dibuat sistem sebagai identitas sebuah laporan |
| **Progres Perbaikan** | Catatan dan foto yang diunggah teknisi selama proses pengerjaan |
| **Data Master** | Data acuan sistem seperti gedung, ruangan, kategori kerusakan, dan teknisi |
| **Data Dummy** | Data contoh/percobaan yang hanya digunakan pada environment pengembangan, bukan produksi |

---

## 20. Lampiran

Dokumen BRD asal menyertakan tiga diagram visual pendukung, yang filenya turut disertakan bersama PRD ini:

- **Gambar 1 — Alur utama proses pelaporan dan perbaikan fasilitas kampus** (lihat Bagian 6).
- **Gambar 2 — Alur status laporan yang digunakan sistem** (lihat Bagian 7).
- **Gambar 3 — Diagram use case sistem Fixora**, menggambarkan hubungan aktor (Pelapor, Admin, Teknisi) dengan fungsi sistem.

---

*Dokumen ini disusun sebagai penjabaran (elaborasi) dari BRD Fixora menjadi format PRD siap eksekusi. Bagian tambahan (persona, metrik, traceability matrix, roadmap, asumsi, dan pertanyaan terbuka) sebaiknya direview bersama product owner/stakeholder sebelum digunakan sebagai acuan final pengembangan.*
