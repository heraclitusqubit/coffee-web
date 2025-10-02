@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>
<form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-2 mb-4">
    <!-- Search -->
    <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}" 
        placeholder="Cari produk..." 
        class="border rounded p-2 w-1/3"
    >

    <!-- Filter kategori -->
    <select name="category" class="border rounded p-2">
        <option value="">Semua Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
        Filter
    </button>
</form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Category</th>
                <th>Image</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                    <td>{{ $p->name }}</td>
                    <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>{{ $p->category ? $p->category->name : '-' }}</td>
                    <td>
                        @if ($p->image)
                            <img src="/storage/{{ $p->image }}" width="80">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $p) }}" method="POST" style="display:inline"
                            onsubmit="return confirm('Hapus produk?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
