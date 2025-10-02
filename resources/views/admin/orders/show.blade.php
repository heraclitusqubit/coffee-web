@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Detail Order #{{ $order->id }}</h2>

        <p><strong>Nama Pembeli:</strong> {{ $order->customer_name }}</p>
        <p><strong>Alamat:</strong> {{ $order->customer_address }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
        <p><strong>Diskon:</strong> Rp {{ number_format($order->discount, 0, ',', '.') }}</p>
        <p><strong>Ongkir:</strong> Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>

        <h4>Items</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Variant</th> {{-- ✅ kolom baru --}}
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->variant ?? '-' }}</td> {{-- ✅ tampilkan variant --}}
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total:
            Rp
            {{ number_format(
                $order->items->sum(fn($i) => $i->qty * $i->price) - $order->discount + $order->shipping_cost,
                0,
                ',',
                '.',
            ) }}
        </h4>
    </div>
@endsection
