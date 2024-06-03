<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;


//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [BerandaController::class, 'index']);
Route::get('add-to-cart/{id}', [BerandaController::class, 'addToCart'])->name('add.to.cart');

//Route::get('/', function(){
    //return view('front.home');
//});
//contoh routing untuk mengarahkan ke view, tanpa melalui controller
Route::get('/percobaan_pertama', function(){
    return view('hello');
});
//contoh routing yang mengarahkan ke dirinya sendiri, tanpa view ataupun conroller
Route::get('/salam', function(){
    return "<h1>Selamat Pagi Peserta MSIB</h1>";
});
//contoh routing yang menggunakan parameter
Route::get('/staff/{nama}/{divisi}', function($nama, $divisi){
    return 'Nama Pegawai '.$nama.'<br> Departemen: '.$divisi;
});

Route::get('/daftar_nilai', function(){
    //return view yang mengarahkan kedalam view yang didalamnya ada folder nilai dan file daftar_nilai
    return view('nilai.daftar_nilai');
});

// Route::get('/dashboard', function(){
//     return view('admin.dashboard');
//
// });


//batasi middleware, yang berguna sebagai pembatas atau validasi antara visitor yang
//sudah memiliki user akses dan belum memiliki akses
Route::group(['middleware' => ['auth', 'checkActive','role:admin|manager|staff']], function(){//fungsi login dan register
    //untuk auth, checkactive dan role itu terapat pada controller midleware yang ada, perhatikan baik baik



// route memanggil conroller setiap fungsi
//prefix and grouping adalah mengelompokkan routing ke satu jenis route
Route::prefix('admin')->group(function(){
    Route::get('/user', [UserController::class, 'index']);

    Route::post('/user/{user}/activate', [UserController::class, 'activate'])->name('admin.user.activate');
    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::patch('profile/{id}', [UserController::class, 'update']);
    //patch atau put dua syntax yang sama untuk digunakan sebagai pengubah data
    //route by name adalah routing yang diberikan penamaan untuk kemudian dipanggil di link
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //route memanggil controller setiap fungsi
    // nanti linknya menggunakan url, ada di dalam view
Route::get('/jenis_produk', [JenisProdukController::class, 'index']);
Route::post('/jenis_produk/store', [JenisProdukController::class, 'store']);
//Route::post('/jenis_produk/create', [JenisProdukController::class, 'store']);

//route dengan pemanggilan class
Route::resource('produk', ProdukController::class);
Route::resource('pelanggan', PelangganController::class);

Route::get('/kartu', [KartuController::class, 'index']);
Route::post('/kartu/store', [KartuController::class, 'store']);
});

});













//tugas kelompok
//1. buat repository github untuk tugas akhir
//2. Ketua kelompok yang jadi branch master
//3. laravel yang diinstal oleh ketua kelompok di push di github
//4. anggota tidak perlu install laravel, melainkan melakukan git clone terhadap repository
//5. setelah cloning lakukan composer install didalam command prompt
//6. collaborate mentor
//ngecek keseluruhan--->  php artisan route:list
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
