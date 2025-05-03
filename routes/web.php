<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/kontak', function () {
//     return view('welcome');
// });

// Route::get('/siswa', function () {
//     return "Saya siswa";
// });

// Route::get('/siswa/{id}/', function ($id) {
//     return "Saya siswa Nim $id";
// })->where('id', '[0-9]+');

// Route::get('/siswa/{id}/{nama}', function ($id, $nama) {
//     return "Saya siswa Nim $id Nama $nama";
// })->where(['id'=>'[0-9]+', 'nama'=>'[A-Za-z]+']);

// Route::get('siswa', [SiswaController::class, 'index']);
// Route::get('siswa/{id}', [SiswaController::class, 'detail'])->where('id', '[0-9]+');

Route::get('/', [HalamanController::class, 'index']);
Route::get('/tentang', [HalamanController::class, 'tentang']);
Route::get('/kontak', [HalamanController::class, 'kontak']);

Route::resource('siswa', SiswaController::class)->middleware('isLogin');

Route::get('/sesi', [SessionController::class, 'index'])->middleware('isTamu');
Route::post('/sesi/login', [SessionController::class, 'login'])->middleware('isTamu');
Route::get('/sesi/logout', [SessionController::class, 'logout']);

Route::get('/sesi/register', [SessionController::class, 'register'])->middleware('isTamu');
Route::post('/sesi/create', [SessionController::class, 'create'])->middleware('isTamu') ;

Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin');
Route::get('/dashboard', [CustomerController::class, 'index'])->middleware('role:customer');


///Produk
Route::resource('produk', ProdukController::class);
// Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
// Route::get('/produk ', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/semuaproduk', [ProdukController::class, 'semua'])->name('produk.semua');
Route::get('/sayuran', [ProdukController::class, 'kategoriSayur'])->name('produk.kategori.sayur');
Route::get('/buahan', [ProdukController::class, 'kategoriBuah'])->name('produk.kategori.buah');
Route::get('/rempahan', [ProdukController::class, 'kategoriRempah'])->name('produk.kategori.rempah');



//update

// //edit
// Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
// Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');

// //delete
// Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');





