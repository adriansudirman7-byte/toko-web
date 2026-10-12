<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;

// 1. Halaman utama langsung lempar ke /produk
Route::get('/', function () {
    return redirect('/produk');
});

// 2. Halaman tentang
Route::get('/tentang', function () {
    return view('tentang');
});

// 3. Route Controller Produk standar - INI YANG WAJIB
// PENTING: /produk/create HARUS DI ATAS /produk/{id}
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');

// 4. Route parameter OPSIONAL (materi LMS - cari)
Route::get('/cari/{kata?}', function ($kata = 'semua') {
    return 'Mencari: ' . $kata;
});

// 5. Pembatasan parameter angka (materi LMS - nota)
// Kita komen dulu biar gak merah kalau NotaController belum ada
// Route::get('/nota/{nomor}', [NotaController::class, 'show'])->whereNumber('nomor');

// 6. Route Group Controller (punya lu yang /katalog)
Route::controller(ProdukController::class)->group(function () {
    Route::get('/katalog', 'index');
    Route::get('/katalog/{id}', 'detail');
});

// 7. Route group admin (materi LMS)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/produk', [ProdukController::class, 'kelola'])->name('produk');
});

// 8. Data JSON
Route::get('/data', function () {
    return ['nama' => 'Laptop', 'harga' => 7500000];
});

// 9. Parameter opsional user
Route::get('/user/{nama?}', function ($nama = 'Tamu') {
    return "Halo, $nama";
});

// 10. PERBAIKAN DARI LMS LESSON 114 — routes/web.php sesudah diperbaiki
// KASUS A — Mengganti logika yang berulang di routes
// Ini yang bikin centang jadi 3/3, wajib ada buat perbaikan
// Kalau belum login, komen dulu ->middleware('auth') nya, ganti jadi seperti di bawah
// Versi tanpa login (biar lu bisa buka):
Route::prefix('admin/laporan')->name('admin.laporan.')->group(function () {
    Route::get('/stok-menipis', [LaporanController::class, 'menipis'])->name('menipis');
    Route::get('/stok-habis', [LaporanController::class, 'habis'])->name('habis');
});

// Kalau sudah ada login, pakai yang ini (sesuai foto LMS persis):
/*
Route::middleware('auth')
    ->prefix('admin/laporan')
    ->name('admin.laporan.')
    ->group(function () {
        Route::get('/stok-menipis', [LaporanController::class, 'menipis'])
            ->name('menipis');
        Route::get('/stok-habis', [LaporanController::class, 'habis'])
            ->name('habis');
    });
*/

// URL : /admin/laporan/stok-menipis
// Nama : admin.laporan.menipis -> route('admin.laporan.menipis')