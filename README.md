# Sistem Perpustakaan

Aplikasi web untuk mengelola data anggota perpustakaan.

[Dashboard](htdoc/perpus/dashboard.png)

## Teknologi

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL
- SweetAlert2

## Struktur Folder

```text
perpus/
├── DASHBOARD/
│   ├── dashboard.php
│   ├── daftar_siswa.php
│   ├── edit.php
│   ├── delete.php
│   ├── db_conn.php
│   ├── dashboardstyle.css
│   ├── daftar_siswa.css
│   └── script.js
│
└── LOGIN_PAGE/
    ├── login_form.php
    ├── register_form.php
    ├── config.php
    └── styles.css

## Cara Menjalankan Aplikasi

1. Install XAMPP.
2. Jalankan Apache dan MySQL.
3. Buat database user_db.
4. Import file user_db.sql.
5. Salin folder perpus ke htdocs.
6. Buka browser.
7. Akses:
   http://localhost/perpus/login_page/login_form.php

## Fitur Aplikasi

- Login
- Register
- Tambah anggota
- Menampilkan data anggota
- Pencarian anggota
- Edit data anggota
- Hapus data anggota
- Validasi form
- SweetAlert2
