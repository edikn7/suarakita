# SuaraKita  
Suarakan Aspirasi, Bangun Sekolah Lebih Baik

SuaraKita adalah aplikasi web pengaduan siswa berbasis PHP dan MySQL yang menyediakan ruang aman, terstruktur, dan transparan bagi siswa untuk menyampaikan aspirasi, kritik, dan pengaduan kepada pihak sekolah.

---

## Latar Belakang
Di lingkungan sekolah, siswa sering mengalami kesulitan dalam menyampaikan keluhan karena:
- Tidak adanya media pengaduan resmi
- Kurangnya transparansi tindak lanjut
- Kekhawatiran akan dampak personal saat menyampaikan aspirasi

SuaraKita hadir sebagai solusi digital untuk menjembatani komunikasi antara siswa dan sekolah secara aman dan terdokumentasi.

---

## Tujuan
- Menyediakan media pengaduan yang aman dan terstruktur
- Meningkatkan transparansi dan akuntabilitas sekolah
- Mendorong budaya komunikasi yang sehat di lingkungan pendidikan

---

## Fitur Utama
### Siswa
- Login siswa
- Mengirim pengaduan
- Melihat riwayat dan status pengaduan
- Memberikan tanggapan lanjutan

### Admin Sekolah
- Dashboard pengaduan
- Menanggapi pengaduan siswa
- Mengelola status pengaduan
- Mengelola data siswa

---

## Use Case Singkat
1. Siswa login ke sistem  
2. Siswa mengirim pengaduan terkait lingkungan sekolah  
3. Pengaduan masuk ke dashboard admin sekolah terkait  
4. Admin membaca dan memberikan tanggapan  
5. Siswa melihat status dan menanggapi kembali jika diperlukan  

Seluruh proses tercatat dan dapat dipantau secara transparan.

---

## Alur Sistem
Siswa Login → Kirim Pengaduan → Admin Menanggapi → Status Diperbarui → Siswa Memantau

---

## Teknologi yang Digunakan
- Frontend : HTML, Tailwind CSS  
- Backend  : PHP (Native)  
- Database : MySQL  

---

## Struktur Proyek
admin/ dashboard admin
siswa/ fitur siswa
auth/ autentikasi
aksi/ proses data
database/ file SQL
assets/ aset tampilan

---

## Cara Menjalankan
1. Clone repository
2. Import database ke phpMyAdmin
3. Atur koneksi database di file `config.php`
4. Jalankan aplikasi melalui localhost

---

## Penutup
SuaraKita dirancang sebagai solusi sederhana namun berdampak untuk meningkatkan komunikasi dan transparansi di lingkungan sekolah.

Proyek ini dibuat untuk keperluan lomba dan pembelajaran.
