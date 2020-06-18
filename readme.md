Aplikasi ini adalah aplikasi penitipan barang dengan sistem Penitip akan menitipkan barangnya ke petugas, lalu sistem akan memberi tegihan atas penitipannya sebanyak ```(jumlah_barang*jumlah_hari*45000)+10%```. aplikasi ini di kelola oleh superadmin, admin, kasir.


1. ini merupakan aplikasi inventaris menggunakan laravel 5.7, dan menggunakan ajax
2. folder vendor tidak di upload, silakan gunakan aplikasi ini dengan menambahkan folder vendor laravel 5.7
3. aplikasi ini menggunakan database mysql
4. pastikan anda telah menginstal composer atau apapun untuk menjalankan laravel

## Instalasi
* Kebutuhan
    + Xampp
    + Composer
1. Download atau clone file ini
2. Akses foldernya di cmd atau terminal lalu ketikkan ```composer install``` (koneksi internet)
3. Setting Env Anda, Ubah nama file ```.env.example``` menjadi ```.env```
4. Jalankan Perintah ```php artisan key:generate```
5. Edit env Anda , perhatikan format berikut :
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_db
    DB_USERNAME=user_db
    DB_PASSWORD=password_db
    ```
5. Ketikkan perintah ```php artisan migrate:refresh --seed``` di cmd atau terminal
6. Masih cmd yang sama ketikkan perintah ```php artisan serve```
7. Ketik ```localhost:8000``` di browser untuk halaman pelanggan
8. Anda bisa login dengan aku berikut : 
    Sebagai superadmin
    > email : khaeruddinasdar12@gmail.com <br>
    > password : 12345678
    
    Sebagai admin
    > email : fattah@gmail.com <br>
    > password : 12345678
    
    Sebagai kasir
    > email : milea@gmail.com <br>
    > password : 12345678
    
9. Selamat menikmati.
