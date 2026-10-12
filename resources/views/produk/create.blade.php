@extends('layouts.app')

@section('judul', 'Tambah Produk')

@section('konten')
<h2>Tambah Produk Baru</h2>

{{-- Ringkasan semua kesalahan di bagian atas --}}
@if ($errors->any())
    <div style="border:2px solid #ef4444; background:#fef2f2; padding:12px; margin-bottom:15px; border-radius:6px;">
        <strong>Periksa kembali isian Anda:</strong>
        <ul>
            @foreach ($errors->all() as $pesan)
                <li>{{ $pesan }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Pesan sukses dari session flash --}}
@if (session('sukses'))
    <div style="border:2px solid #10b981; background:#f0fdf4; padding:12px; margin-bottom:15px; border-radius:6px;">
        {{ session('sukses') }}
    </div>
@endif

<form action="{{ route('produk.store') }}" method="POST">
    @csrf

    <label for="nama">Nama Produk</label><br>
    {{-- old() mengembalikan isian sebelumnya agar tidak hilang --}}
    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required><br>
    {{-- Pesan kesalahan khusus untuk field ini --}}
    @error('nama')
        <small style="color:#ef4444;">{{ $message }}</small><br>
    @enderror
    <br>

    <label for="harga">Harga</label><br>
    <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required><br>
    @error('harga')
        <small style="color:#ef4444;">{{ $message }}</small><br>
    @enderror
    <br>

    <label for="stok">Stok</label><br>
    <input type="number" id="stok" name="stok" value="{{ old('stok') }}" required><br>
    @error('stok')
        <small style="color:#ef4444;">{{ $message }}</small><br>
    @enderror
    <br>

    <label for="email">Email Supplier</label><br>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required><br>
    @error('email')
        <small style="color:#ef4444;">{{ $message }}</small><br>
    @enderror
    <br>

    <label for="kategori">Kategori</label><br>
    <select id="kategori" name="kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="elektronik" {{ old('kategori') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
        <option value="atk" {{ old('kategori') == 'atk' ? 'selected' : '' }}>Alat Tulis</option>
        <option value="makanan" {{ old('kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
    </select><br>
    @error('kategori')
        <small style="color:#ef4444;">{{ $message }}</small><br>
    @enderror
    <br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('produk.index') }}">Kembali ke Daftar</a>
@endsection