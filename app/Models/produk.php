<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Konvensi: class Produk -> Laravel cari tabel "produks".
    // Kalau tabel Anda bernama "produk", nyatakan eksplisit:
    protected $table = 'produk';

    // Kolom yang boleh diisi sekaligus lewat create() / update()
    protected $fillable = ['nama', 'harga', 'stok', 'kategori', 'email'];

    // Kolom yang tidak pernah ikut ditampilkan saat diubah ke JSON
    protected $hidden = ['harga_modal'];

    /**
     * GABUNGAN DARI LMS KANAN:
     * Scope: potongan query yang diberi nama agar bisa dipakai berulang
     * Cara pakai: Produk::stokMenipis()->get()
     */
    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    /**
     * GABUNGAN DARI LMS KIRI (Perbaikan 1/3):
     * Query pencarian diberi nama; parameter di-binding, aman dari injeksi
     * Cara pakai: Produk::cari($request->input('cari'))->get()
     */
    public function scopeCari($query, ?string $kata)
    {
        return $query->when($kata, function ($q) use ($kata) {
            return $q->where('nama', 'like', '%' . $kata . '%');
        });
    }

    /**
     * Accessor: kolom buatan yang dihitung, bukan disimpan di database
     * Cara pakai: $produk->status_stok -> akan otomatis panggil fungsi ini
     */
    public function getStatusStokAttribute()
    {
        if ($this->stok == 0) return 'Habis';
        if ($this->stok < 3) return 'Kritis';
        return 'Menipis';
    }
}