# api-mahasiswa
Repository untuk mengembangkan bersama data dalam bentuk API

# Petunjuk Sebelum Mulai Menggunakan API pada Local Device masing - masing
```bash
$ Download dan Install Git : https://git-scm.com/download/win
$ Download dan Install XAMPP (PHP versi 7) : https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.33/xampp-windows-x64-7.4.33-0-VC15-installer.exe/download
$ Download dan Install Composer : https://getcomposer.org/download/
```
Fungsi untuk masing - masing tools ini akan dijelaskan pada saat pelatihan

## Installation

```bash
$ Clone project ini dengan perintah : git clone https://github.com/musyahid/api-mahasiswa.git
$ Lalu didalam project Jalankan perintah : composer install
```

## Ketentuan Yang Harus diperhatikan

```bash
$ Buat file pada directory utama dengan nama .env
$ Pada file .env buat variabel (BASE_URL, EMAIL dan PASSWORD) sesuai dengan contoh yang ada pada file .env.example
$ Isikan Variabel BASE_URL sesuai dengan yang terdapat pada deskripsi group "API SRS-UT"
$ Isikan Variabel Email dan Password dengan Akun pada saat login di aplikasi https://srs5g.ut.ac.id
Lakukan Uji coba dengan mengakses URL Local pada browser dengan URL berikut :
$ http://localhost/api-mahasiswa/data-mahasiswa.php (Get Data Mahasiswa By NIM)
$ http://localhost/api-mahasiswa/data-billing.php (Get Data Billing mahasiswa By NIM dan Masa)
```

SELAMAT MENCOBA :)
