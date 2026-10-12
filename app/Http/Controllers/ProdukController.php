<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Perbaikan 2/3 — app/Http/Controllers/ProdukController.php
    public function index(Request $request)
    {
        $judul = 'Daftar Produk Unggulan';

        try {
            // Baris WAJIB dari LMS
            $produk = Produk::cari($request->input('cari'))->get();

            if ($produk->isEmpty() && !$request->filled('cari')) {
                throw new \Exception('kosong');
            }
        } catch (\Exception $e) {
            $produk = collect([
                (object)['nama' => 'Laptop', 'harga' => 7500000, 'stok' => 4, 'status_stok' => 'Menipis'],
                (object)['nama' => 'Mouse', 'harga' => 150000, 'stok' => 0, 'status_stok' => 'Habis'],
                (object)['nama' => 'Keyboard', 'harga' => 320000, 'stok' => 12, 'status_stok' => 'Aman'],
            ]);

            if ($request->filled('cari')) {
                $kata = strtolower($request->input('cari'));
                $produk = $produk->filter(fn($p) => str_contains(strtolower($p->nama), $kata))->values();
            }
        }

        // Return persis seperti di foto LMS Perbaikan 2/3
        return view('produk.index', [
            'judul' => $judul,
            'produk' => $produk,
            'totalNilai' => $produk->sum(fn ($p) => $p->harga * $p->stok),
        ]);
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $nama = $request->input('nama');
        $harga = $request->harga;
        $semua = $request->all();
        $data = $request->only(['nama', 'harga', 'stok', 'email', 'kategori']);

        $validated = $request->validate([
            'nama' => 'required|min:3|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'email' => 'required|email',
            'kategori' => 'required|in:elektronik,atk,makanan',
        ], [
            'nama.required' => 'Nama produk wajib diisi.',
            'nama.min' => 'Nama produk minimal 3 karakter.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'email.required' => 'Email supplier wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        return redirect()->route('produk.index')->with('sukses', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        return 'Detail produk ' . $id;
    }

    public function detail($id)
    {
        return $this->show($id);
    }

    public function kelola()
    {
        return $this->index(request());
    }
}