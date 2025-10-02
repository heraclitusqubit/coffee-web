<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    {{-- <div class="container mt-5">
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
            <div class="mb-3">
                <label>Diskon (Rp)</label>
                <input type="number" name="discount" class="form-control" value="0">
            </div>
            <div class="mb-3">
                <label>Ongkir (Rp)</label>
                <input type="number" name="shipping_cost" class="form-control" value="0">
            </div>
            <h4>Ringkasan Pesanan</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Variant</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach (session('cart') as $item)
                        @php
                            $subtotal = $item['price'] * $item['qty'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['variant'] ?? '-' }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <td class="list-group-item border-1 d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                    </td>
                </tbody>
            </table>


            <button type="submit" class="btn btn-success">Buat Pesanan</button>
            <a href="{{ route('cart.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div> --}}
    <div class="container mt-5">
        <h2>Checkout</h2>
        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
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
            <div class="mb-3">
                <label>Diskon (Rp)</label>
                <input type="number" name="discount" id="discount" class="form-control" value="0">
            </div>
            <div class="mb-3">
                <label>Ongkir (Rp)</label>
                <input type="number" name="shipping_cost" id="shipping_cost" class="form-control" value="0">
            </div>

            {{-- 🔹 Metode pembayaran --}}
            <div class="mb-3">
                <label>Metode Pembayaran</label>
                <select name="payment_method" class="form-control" required>
                    <option value="COD">COD (Bayar di Tempat)</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet (Dana / OVO / Gopay)</option>
                </select>
            </div>

            <h4>Ringkasan Pesanan</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Variant</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    @foreach (session('cart') as $item)
                        @php
                            $lineTotal = $item['price'] * $item['qty'];
                            $subtotal += $lineTotal;
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['variant'] ?? '-' }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($lineTotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- 🔹 Ringkasan pembayaran realtime --}}
            <h4>Ringkasan Pembayaran</h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Subtotal</span>
                    <strong id="subtotal">{{ number_format($subtotal, 0, ',', '.') }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Diskon</span>
                    <strong id="discountDisplay">0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Ongkir</span>
                    <strong id="shippingDisplay">0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong id="total">{{ number_format($subtotal, 0, ',', '.') }}</strong>
                </li>
            </ul>

            <button type="submit" class="btn btn-success">Buat Pesanan</button>
            <a href="{{ route('cart.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    {{-- 🔹 Script untuk update total --}}
    <script>
        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        function updateTotal() {
            let subtotal = {{ $subtotal }};
            let discount = parseInt(document.getElementById('discount').value) || 0;
            let shipping = parseInt(document.getElementById('shipping_cost').value) || 0;
            let total = subtotal - discount + shipping;

            document.getElementById('discountDisplay').textContent = formatNumber(discount);
            document.getElementById('shippingDisplay').textContent = formatNumber(shipping);
            document.getElementById('total').textContent = formatNumber(total);
        }

        document.getElementById('discount').addEventListener('input', updateTotal);
        document.getElementById('shipping_cost').addEventListener('input', updateTotal);
    </script>

</body>

</html>
