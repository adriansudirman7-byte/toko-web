@extends('layouts.app')
@section('judul', 'Daftar Produk')
@section('konten')

<h2>{{ $judul ?? 'Daftar Produk' }}</h2>

{{-- Form Pencarian untuk scopeCari --}}
<form method="GET" action="{{ route('produk.index') }}" style="margin-bottom:15px;">
    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama produk...">
    <button type="submit">Cari</button>
    @if(request('cari'))
        <a href="{{ route('produk.index') }}">Reset</a>
    @endif
</form>

<p>Total produk: {{ count($produk) }} item</p>

{{-- Perbaikan 3/3 dari LMS: Ciri View yang sehat, tidak ada query --}}
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status Stok</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($produk as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>Rp{{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>
                    @if ($p->stok > 0)
                        <span style="color: green;">Tersedia ({{ $p->stok }})</span>
                    @else
                        <span style="color: red;">Stok habis</span>
                    @endif
                </td>
                <td>{{ $p->status_stok ?? ($p->stok == 0 ? 'Habis' : ($p->stok < 3 ? 'Kritis' : 'Aman')) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center;">Produk tidak ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Baris WAJIB dari LMS Perbaikan 3/3 --}}
<p style="margin-top:15px;"><strong>Total nilai persediaan: Rp{{ number_format($totalNilai ?? 0) }}</strong></p>

@if(session('sukses'))
    <p style="color: green;">{{ session('sukses') }}</p>
@endif

{{-- <p style="margin-top:10px;"><a href="{{ route('produk.create') }}">+ Tambah Produk Baru</a></p> --}}

@endsection