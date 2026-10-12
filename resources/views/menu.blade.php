{{-- CARA LAMA: rapuh, alamat ditulis manual --}}
<a href="/daftar-produk">Produk</a>

{{-- CARA BENAR: memakai nama route --}}
<a href="{{ route('produk.index') }}">Produk</a>

{{-- Named route dengan parameter --}}
<a href="{{ route('produk.detail', 7) }}">Lihat Produk #7</a>