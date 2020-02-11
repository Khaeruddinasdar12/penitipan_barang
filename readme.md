Aplikasi ini adalah aplikasi penitipan barang dengan sistem Penitip akan menitipkan barangnya ke petugas, lalu sistem akan memberi tegihan atas penitipannya sebanyak (jumlah_barang*jumlah_hari*45000)+10%. aplikasi ini di kelola oleh superadmin, admin, kasir.


1. ini merupakan aplikasi inventaris menggunakan laravel 5.7, dan menggunakan ajax
2. folder vendor tidak di upload, silakan gunakan aplikasi ini dengan menambahkan folder vendor laravel 5.7
3. aplikasi ini menggunakan database mysql
4. pastikan anda telah menginstal composer atau apapun untuk menjalankan laravel

Konfigurasi

1. Download atau clone file ini
2. pastikan step no. 2 diatas sudah di laksanakan.
3. buka cmd lalu aktifkan direktori/folder yang telah Anda download.
4. di aplikasi ini saya menggunakan yajra Datatables maka perlu Anda tambahkan yajra di folder project Anda, masuk ke folder project Anda lalu ketik sebagai berikut di cmd

composer require yajra/laravel-datatables-oracle:"~8.0"

tambahkan kode ini di config/app.php

'providers' => [ Yajra\DataTables\DataTablesServiceProvider::class, ]

'aliases' => [ 'DataTables' => Yajra\DataTables\Facades\DataTables::class, ]

lalu di cmd ketikkan

php artisan vendor:publish

5. databasenya tersedia, buat database Anda terlebih dahulu, silakan lakukan konfigurasi di env lalu ketikkan perintah php artisan migrate di cmd untuk mendapatkan databasenya.
6. untuk membuat sebuah akun, lakukan lewat artisan tinker, silakan mengisi data users dengan fitur tinker tersebut,
7. Model untuk insert akunnya adalah '$data = \App\User;' 

8. jika selesai,silakan login dengan mengetik di browser localhost:8000, atau sesuai server Anda
9. untuk melihat gambar dari sistem, maka ketikkan di cmd 'php artisan storage:link' 
