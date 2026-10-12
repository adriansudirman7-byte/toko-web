<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Produk; // <-- TAMBAHAN BUAT MATERI LMS

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// --- TAMBAHAN DARI LMS (Poin 5 di foto lu) ---
// URL sesungguhnya: /api/produk (awalan /api ditambahkan otomatis)
// Bedanya sama web.php: ini ngembaliin JSON, bukan view
Route::get('/produk', function () {
    return response()->json([
        'status' => 'ok',
        'data' => Produk::all(),
    ]);
});