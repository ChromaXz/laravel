<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/percobaan_pertama', function(){
    return view('hello');
});

//tugas kelompok
//1. buat repository github untuk tugas akhir
//2. Ketua kelompok yang jadi branch master
//3. laravel yang diinstal oleh ketua kelompok di push di github
//4. anggota tidak perlu install laravel, melainkan melakukan git clone terhadap repository
//5. setelah cloning lakukan composer install didalam command prompt
//6. collaborate mentor