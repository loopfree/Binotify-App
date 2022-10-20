# Tugas Besar 1 IF3110 

## Deskripsi Aplikasi Web

## Daftar Requirement
1. [Docker](https://www.docker.com/get-started)
2. [PHP](https://www.php.net/)

## Cara Instalasi
1. Download atau clone repo ini
2. Lakukan setting pada file `php.ini-develop`
   1. Ubah nama file `php.ini-develop` menjadi `php.ini`
   2. Pada file `php.ini` Cari `;extension=pgsql` lalu hilangkan `;`
   3. Pada file `php.ini` Cari `upload_max_filesize` lalu ganti nilainya menjadi 0. Dalam hal ini, pengaturan nilai menjadi 0 berarti mengganti nilai maksimum upload filesize menjadi takhingga
   4. Pada file `php.ini` Cari `post_max_size` lalu ganti nilainya menjadi 0. Dalam hal ini, pengaturan nilai menjadi 0 berarti mengganti nilai maksimum post filesize menjadi takhingga
3. Buatlah database
4. Jalankan terminal pada folder src
5. Eksekusi perintah berikut
    ```
    php -S localhost:8080
    ```

## Cara Menjalankan Server

## Screenshot Tampilan Aplikasi

## Pembagian Tugas Anggota