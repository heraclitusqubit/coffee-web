@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detail Pesanan #{{ $order->id }}</h1>
    <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
    <p><strong>Alamat:</strong> {{ $order->customer_address }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <hr>
    <h4>Item Pesanan:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h4>
</div>
@endsection
