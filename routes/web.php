<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;

Route::pattern('id', '[0-9]+'); // Pastilan parameter {id} hanya berupa angaka

// Route otentikasi
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth'])->group(function () {
    // artinya semua route di dalam group ini harus login dulu
    Route::get('/', [WelcomeController::class, 'index']);

    Route::get('/profil', [ProfilController::class, 'index']);    // lihat profil
    Route::get('/profil/edit', [ProfilController::class, 'edit']);   // form edit
    Route::put('/profil/update', [ProfilController::class, 'update']);    // simpan perubahan

    // route CRUD user
    Route::middleware(['authorize:ADM'])->prefix('user')->group(function () {
    // artinya semua route di dalam gruop ini harus punya role ADM (Administrator)
        Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
        Route::post("/list", [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
        
        // Create dengan ajax
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru ajax
        
        Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
        
        // Edit dengan ajax
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
        
        // Delete dengan ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); //menampilkan form confirm delete user ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
        Route::get('/{id}/show_ajax', [UserController::class, 'showAjax']);

        // Routes import dan Export untuk User
        Route::get('/import', [UserController::class, 'import']);
        Route::post('/import_ajax', [UserController::class, 'import_ajax']);
        Route::get('/export_excel', [UserController::class, 'export_excel']);
        Route::get('/export_pdf', [UserController::class, 'export_pdf']);
    });
    
    // route CRUD level
    Route::middleware(['authorize:ADM'])->prefix('level')->group(function () {
    // artinya semua route di dalam gruop ini harus punya role ADM (Administrator)
        Route::get('/', [LevelController::class, 'index']); // menampilkan halaman awal level
        Route::post('/list', [LevelController::class, 'list']); // menampilkan data level dalam bentuk json untuk datatables
        Route::get('/create', [LevelController::class, 'create']); // menampilkan halaman form tambah level
        Route::post('/', [LevelController::class, 'store']); // menyimpan data level baru
    
        // Create dengan ajax
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah level ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']); // menyimpan data level baru ajax
    
        Route::get('/{id}', [LevelController::class, 'show']); // menampilkan detail level
        Route::get('/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
        Route::put('/{id}', [LevelController::class, 'update']); // menyimpan perubahan data level
    
        // Edit dengan ajax
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // menampilkan halaman form edit level ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level ajax
    
        // Delete dengan ajax
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // menampilkan form confirm delete level ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level ajax
        Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level

        // Routes import dan Export untuk Level
        Route::get('/import', [LevelController::class, 'import']);
        Route::post('/import_ajax', [LevelController::class, 'import_ajax']);
        Route::get('/export_excel', [LevelController::class, 'export_excel']);
        Route::get('/export_pdf', [LevelController::class, 'export_pdf']);
    });

    
    //route CRUD kategori
    Route::middleware(['authorize:ADM,MNG'])->prefix('kategori')->group(function () {
    // artinya semua route di dalam group ini harus punya role ADM (Administrator) dan MNG (Manager)
        Route::get('/', [KategoriController::class, 'index']); // menampilkan halaman awal kategori
        Route::post("/list", [KategoriController::class, 'list']); // menampilkan data kategori dalam bentuk json untuk datatables
        Route::get('/create', [KategoriController::class, 'create']); // menampilkan halaman form tambah kategori
        Route::post('/', [KategoriController::class, 'store']); // menyimpan data kategori baru
    
        // Create dengan ajax
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data kategori baru ajax
    
        Route::get('/{id}', [KategoriController::class, 'show']); // menampilkan detail kategori
        Route::get('/{id}/edit', [KategoriController::class, 'edit']); // menampilkan halaman form edit kategori
        Route::put('/{id}', [KategoriController::class, 'update']); // menyimpan perubahan data kategori
    
        // Edit dengan ajax
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit kategori ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax
    
        // Delete dengan ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); //menampilkan form confirm delete kategori ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori ajax
        Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori

        // Routes import dan Export untuk Kategori
        Route::get('/import', [KategoriController::class, 'import']);
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']);
        Route::get('/export_excel', [KategoriController::class, 'export_excel']);
        Route::get('/export_pdf', [KategoriController::class, 'export_pdf']);
    });
    
    //route CRUD supplier
    Route::middleware(['authorize:ADM,MNG'])->prefix('supplier')->group(function () {
    // artinya semua route di dalam group ini harus punya role ADM (Administrator) dan MNG (Manager)
        Route::get('/', [SupplierController::class, 'index']);
        Route::post('/list', [SupplierController::class, 'list']);
        Route::get('/create', [SupplierController::class, 'create']);
        Route::post('/', [SupplierController::class, 'store']);
    
        // Create dengan ajax
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);
    
        Route::get('/{id}', [SupplierController::class, 'show']);
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);
        Route::put('/{id}', [SupplierController::class, 'update']);
    
        // Edit dengan ajax
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
    
        // Delete dengan ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::delete('/{id}', [SupplierController::class, 'destroy']);

        // Routes import dan Export untuk Supplier
        Route::get('/import', [SupplierController::class, 'import']);
        Route::post('/import_ajax', [SupplierController::class, 'import_ajax']);
        Route::get('/export_excel', [SupplierController::class, 'export_excel']);
        Route::get('/export_pdf', [SupplierController::class, 'export_pdf']);
    });
    
    //route CRUD barang
    // Route: Semua level (ADM, MNG, STF) bisa lihat data barang dan detail
    Route::middleware(['authorize:ADM,MNG,STF,KSR'])->prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/list', [BarangController::class, 'list']);
        Route::get('/{id}/show_ajax', [BarangController::class, 'showAjax']);
    });

    // Route: Hanya ADM dan MNG yang bisa akses fitur tambah/edit/hapus
    Route::middleware(['authorize:ADM,MNG'])->prefix('barang')->group(function () {
        Route::get('/create', [BarangController::class, 'create']);
        Route::post('/', [BarangController::class, 'store']);
        
        // Create dengan Ajax
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/ajax', [BarangController::class, 'store_ajax']);

        Route::get('/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/{id}', [BarangController::class, 'update']);

        // Edit dengan Ajax
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);

        // Delete dengan Ajax
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::delete('/{id}', [BarangController::class, 'destroy']);

        // Routes Import dan Export untuk Barang
        Route::get('/import', [BarangController::class, 'import']);
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']);
        Route::get('/export_excel', [BarangController::class, 'export_excel']);
        Route::get('/export_pdf', [BarangController::class, 'export_pdf']);
    });
   
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/