<?php
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\SalesController;
?>

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;

// Halaman Home
Route::get('/', function(){
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);


// --- TUGAS JOBSHEET2 ---
// Halaman Home
// Route::get('/', [HomeController::class, 'index']);

//Route::get('/kategori', [KategoriController::class, 'index']);

// Halaman Products dengan prefix category
// Route::prefix('category')->group(function () {
// Route::get('/food-beverage', [ProductController::class, 'foodBeverage']);
// Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
// Route::get('/home-care', [ProductController::class, 'homeCare']);
// Route::get('/baby-kid', [ProductController::class, 'babyKid']);
// });

// Halaman User dengan parameter ID dan Name
// Route::get('/user/{id}/name/{name}', [UserController::class, 'profile']);

// Halaman Penjualan
// Route::get('/sales', [SalesController::class, 'index']);
