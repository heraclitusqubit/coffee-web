<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Checkout</h2>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="customer_address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>No HP (opsional)</label>
            <input type="text" name="customer_phone" class="form-control">
        </div>

        <h4>Ringkasan Pesanan</h4>
        <ul class="list-group mb-3">
            @php $total = 0; @endphp
            @foreach($cart as $item)
              @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $item['name'] }} (x{{ $item['qty'] }})
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
              </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
              <strong>Total</strong>
              <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </li>
        </ul>

        <button type="submit" class="btn btn-success">Buat Pesanan</button>
        <a href="{{ route('cart.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
