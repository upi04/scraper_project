<!DOCTYPE html>
<html>
<head>
    <title>Edit Laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow" style="background: linear-gradient(to right, #4e54c8, #8f94fb); border-radius: 0 0 20px 20px;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-white fs-4" href="{{ route('dashboard') }}">💻 Panrita Laptop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="/laptop/input">➕ Input Laptop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="/laptop/list">📋 List Laptop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('laptop.sold') }}">✅ Terjual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        🚪 Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Laptop</h2>

    <<form method="POST" action="/laptop/update/{{ $laptop->id }}">
    @csrf
    <div class="mb-3">
        <label>Brand</label>
        <input type="text" name="brand" class="form-control" value="{{ $laptop->brand }}" required>
    </div>
    <div class="mb-3">
        <label>Model</label>
        <input type="text" name="model" class="form-control" value="{{ $laptop->model }}" required>
    </div>
    <div class="mb-3">
        <label>Harga Beli</label>
        <input type="number" name="price" class="form-control" value="{{ $laptop->price }}" required>
    </div>
    <div class="mb-3">
        <label>Harga Jual</label>
        <input type="number" name="selling_price" class="form-control" value="{{ $laptop->selling_price }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

</body>
</html>
