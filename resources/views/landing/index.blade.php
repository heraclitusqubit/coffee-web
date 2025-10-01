<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Landing Page Toko Kopi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing.index') }}">☕ Toko Kopi</a>
            <a href="{{ url('/cart') }}" class="btn btn-outline-light">Cart</a>
        </div>
        <div class="mb-4">
            <h4>Filter Kategori</h4>
            <a href="{{ route('landing.index') }}"
                class="btn btn-sm btn-outline-secondary {{ !isset($category) ? 'active' : '' }}">
                Semua
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('landing.byCategory', $cat->id) }}"
                    class="btn btn-sm btn-outline-secondary {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>


    </nav> --}}

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('landing.index') }}">Coffee Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                {{-- Link Home --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('landing.index') }}">Home</a>
                </li>

                {{-- Dropdown Category --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {{-- Semua kategori --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('landing.index') }}">
                                Semua
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        {{-- Loop kategori --}}
                        @foreach($categories as $cat)
                            <li>
                                <a class="dropdown-item {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}"
                                   href="{{ route('landing.byCategory', $cat->id) }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="container mt-4">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if ($product->image)
                            <img src="/storage/{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="placeholder">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <p><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                            <a href="{{ url('/cart/add/' . $product->id) }}" class="btn btn-primary">Tambah ke Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
