<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4">Keranjang Belanja</h2>
        <a href="{{ route('landing.index') }}" class="btn btn-secondary mb-3">← Kembali Belanja</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('cart') && count(session('cart')) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Varian</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach (session('cart') as $key => $item)
                        @php
                            $subtotal = $item['price'] * $item['qty'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item['image']) }}" width="60" class="me-2">
                                {{ $item['name'] }}
                            </td>
                            <td>{{ $item['variant'] }}</td>
                            <td>
                                <form action="{{ route('cart.update', $key) }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                        class="form-control me-2" style="width:80px">
                                    <button class="btn btn-sm btn-success">Update</button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $key) }}" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total</td>
                        <td colspan="2" class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-end">
                <a href="{{ route('cart.clear') }}" class="btn btn-warning">Kosongkan Cart</a>
                <a href="{{ url('/checkout') }}" class="btn btn-primary btn-lg">Checkout</a>
            </div>
        @else
            <p>Keranjang masih kosong.</p>
        @endif
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
