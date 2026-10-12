<table border="1">
    <tr><th>No</th><th>Nama</th><th>Harga</th></tr>
@forelse ($produk as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item['nama'] }}</td>
        <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
    </tr>
@empty
    <tr><td colspan="3">Belum ada produk yang tersedia.</td></tr>
@endforelse
</table>