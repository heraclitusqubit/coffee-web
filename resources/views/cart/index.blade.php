<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Keranjang Belanja</h2>
    <a href="{{ route('landing.index') }}" class="btn btn-secondary mb-3">← Kembali Belanja</a>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0; @endphp
          @foreach($cart as $id => $item)
            @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
            <tr>
              <td>{{ $item['name'] }}</td>
              <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
              <td>
                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                  @csrf
                  <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="form-control me-2" style="width:80px">
                  <button class="btn btn-sm btn-success">Update</button>
                </form>
              </td>
              <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
              <td>
                <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger">Hapus</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <h4>Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
      <a href="{{ route('cart.clear') }}" class="btn btn-warning">Kosongkan Cart</a>
      <a href="{{ url('/checkout') }}" class="btn btn-primary">Checkout</a>
    @else
      <p>Keranjang kosong.</p>
    @endif
</div>
</body>
</html>
