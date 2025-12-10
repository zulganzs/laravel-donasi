# Panduan Instalasi Website PeduliSesama

Halo! Ini adalah panduan cara menjalankan website PeduliSesama di komputer kamu. Ikuti langkah-langkah di bawah ini ya.

## 1. Persiapan (Download Aplikasi Pendukung)

Sebelum mulai, pastikan kamu sudah menginstall aplikasi berikut:

1.  **XAMPP** (Untuk database): [Download di sini](https://www.apachefriends.org/download.html). Pilih versi PHP 8.1 atau 8.2.
2.  **Composer** (Untuk install library PHP): [Download di sini](https://getcomposer.org/Composer-Setup.exe). Install dan klik "Next" terus sampai selesai.
3.  **Node.js** (Untuk tampilan website): [Download di sini](https://nodejs.org/dist/v20.10.0/node-v20.10.0-x64.msi). Pilih versi LTS.
4.  **Git** (Opsional, tapi bagus kalau ada): [Download di sini](https://git-scm.com/download/win).

## 2. Cara Install Website

1.  Buka folder proyek ini.
2.  Klik kanan di ruang kosong, lalu pilih **"Open in Terminal"** (atau Git Bash Here / Open PowerShell window here).
3.  Ketik perintah ini satu per satu dan tekan Enter:

    ```bash
    composer install
    ```
    *(Tunggu sampai selesai download library)*

    ```bash
    npm install
    ```
    *(Tunggu sampai selesai)*

    ```bash
    copy .env.example .env
    ```
    *(Ini untuk membuat file pengaturan)*

    ```bash
    php artisan key:generate
    ```
    *(Ini untuk membuat kunci keamanan aplikasi)*

## 3. Mengatur Database

1.  Buka aplikasi **XAMPP Control Panel**.
2.  Klik tombol **Start** pada **Apache** dan **MySQL**.
3.  Buka browser (Chrome/Edge) dan ketik: `http://localhost/phpmyadmin`
4.  Klik **"New"** di sebelah kiri.
5.  Isi nama database dengan: `laravel_donasi` (atau nama lain, tapi harus sama dengan pengaturan).
6.  Klik **Create**.

## 4. Menghubungkan Website ke Database

1.  Buka file bernama `.env` di folder proyek ini (buka pakai Notepad atau VS Code).
2.  Cari bagian ini dan sesuaikan:

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_donasi  <-- Pastikan ini sama dengan nama database yang kamu buat tadi
    DB_USERNAME=root
    DB_PASSWORD=                <-- Kosongkan jika pakai XAMPP default
    ```

3.  Simpan file `.env`.

4.  Kembali ke terminal, jalankan perintah ini untuk mengisi database:

    ```bash
    php artisan migrate:fresh --seed
    ```
    *(Ketik 'yes' jika ditanya)*

## 5. Menjalankan Website

Sekarang saatnya menjalankan website! Kamu butuh **dua** terminal yang jalan bersamaan.

**Terminal 1 (Untuk menjalankan server PHP):**
```bash
php artisan serve
```
*Akan muncul tulisan: Server running on [http://127.0.0.1:8000]*

**Terminal 2 (Untuk menjalankan tampilan/CSS):**
Buka terminal baru di folder yang sama, lalu ketik:
```bash
npm run dev
```

## 6. Selesai!

Buka browser dan kunjungi: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

Selamat, website sudah jalan! 🎉

---

### Masalah yang Sering Muncul

*   **Error "Vite manifest not found"**: Pastikan kamu sudah menjalankan `npm run dev` di terminal kedua.
*   **Error Database**: Pastikan XAMPP (MySQL) sudah di-Start.
*   **Gambar tidak muncul**: Jalankan perintah `php artisan storage:link` di terminal.
