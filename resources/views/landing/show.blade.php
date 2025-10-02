<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded"
                    alt="{{ $product->name }}">
            </div>

            <!-- Detail Produk -->
            <div class="col-md-6">
                <h2 class="fw-bold">{{ $product->name }}</h2>
                <p class="text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                <p>{{ $product->description }}</p>

                <!-- Varian -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="variant" class="form-label">Pilih Varian</label>
                        <select name="variant" id="variant" class="form-select" required>
                            <option value="Biji">Biji</option>
                            <option value="Fine Espresso">Fine Espresso</option>
                            <option value="Pour Over">Pour Over</option>
                            <option value="Coarse">Coarse</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Jumlah</label>
                        <input type="number" name="qty" id="qty" value="1" min="1"
                            class="form-control w-25" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-cart-plus"></i> Tambah ke Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
