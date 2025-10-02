<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Landing Page Toko Kopi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('landing.index') }}">Coffee Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    {{-- Home --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing.index') }}">Home</a>
                    </li>

                    {{-- Categories Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('landing.index') }}">Semua</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @foreach ($categories as $cat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('landing.byCategory', $cat->id) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart"></i> Cart
                            @if (session('cart'))
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 text-center bg-light"
        style="background: url('{{ asset('storage') }}/products/coffee-bg.png') center/cover no-repeat; color: white;">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di Coffee Shop</h1>
            <p class="lead mb-4">Nikmati kopi terbaik dengan biji pilihan roasted fresh setiap hari</p>
            <a href="#products" class="btn btn-primary btn-lg">Belanja Sekarang</a>
        </div>
    </section>
    {{-- form search --}}
    <div class="py-3 container">
        <form action="{{ route('landing.index') }}" method="GET" class="d-flex gap-2 mb-4">
            <!-- Search -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                class="form-control w-25">

            <!-- Filter kategori -->
            <select name="category" class="form-select w-25">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">
                Cari
            </button>
        </form>
    </div>
    {{-- card product --}}

    <section id="products" class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Produk Terbaru</h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                                <p class="fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                </form>
                                <a href="{{ route('landing.show', $product->id) }}"
                                    class="btn btn-sm btn-outline-primary w-100 mt-1">
                                    View Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol lihat semua -->
            <div class="text-center mt-4">
                <a href="{{ route('landing.index') }}" class="btn btn-outline-primary">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    {{ $products->links() }}
    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <!-- Tentang -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Tentang Kami</h5>
                    <p>
                        Kami adalah roastery kecil yang menyediakan biji kopi pilihan,
                        fresh roasted setiap hari untuk menemani momen terbaik Anda.
                    </p>
                </div>

                <!-- Kontak -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt"></i> Jl. Kopi No. 123, Jakarta</li>
                        <li><i class="bi bi-telephone"></i> +62 812 3456 7890</li>
                        <li><i class="bi bi-envelope"></i> hello@coffeeshop.com</li>
                    </ul>
                </div>

                <!-- Sosial Media -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Ikuti Kami</h5>
                    <a href="#" class="text-light me-3"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-twitter fs-4"></i></a>
                </div>
            </div>

            <hr class="border-secondary">

            <div class="text-center">
                <small>&copy; {{ date('Y') }} Coffee Shop. All rights reserved.</small>
            </div>
        </div>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
