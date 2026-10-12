<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('judul', 'Toko Web') | Politeknik Amamapare</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('css')
</head>
<body>

    <header>
        <h1>Toko Web</h1>
        <nav>
            <a href="{{ route('produk.index') }}">Produk</a>
            <a href="{{ route('produk.create') }}">Tambah Produk</a>
        </nav>
    </header>

    <main>
        @yield('konten')
    </main>

    <footer>
        <p>&copy; 2026 Politeknik Amamapare Timika</p>
    </footer>

    @stack('js')
</body>
</html>