<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap biar cepat styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/admin/products') }}">Admin Panel</a>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light btn-sm me-2">Products</a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-light btn-sm">Orders</a>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
