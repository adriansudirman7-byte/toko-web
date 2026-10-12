{{-- ❌ Rapuh: rusak kalau aplikasi dipindah ke sub-folder --}}
<img src="/img/logo.png">

{{-- ✅ Benar: alamat lengkap dibuat otomatis oleh Laravel --}}
<img src="{{ asset('img/logo.png') }}" alt="Logo Kampus">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="{{ asset('js/app.js') }}"></script>

{{-- Membuat alamat penuh ke sebuah halaman --}}
<a href="{{ url('/produk') }}">Produk</a>

{{-- Lebih dianjurkan: pakai named route dari Pertemuan 2 --}}
<a href="{{ route('produk.index') }}">Produk</a>