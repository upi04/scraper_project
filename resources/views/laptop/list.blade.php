<!DOCTYPE html>
<html>
<head>
    <title>Daftar Laptop</title>
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
    <h2 class="text-center mb-4">Daftar Laptop</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Fitur sortir -->
    <form method="GET" action="/laptop/list" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="sort_by" class="form-select">
                    <option value="price" {{ $sortBy == 'price' ? 'selected' : '' }}>Harga</option>
                    <option value="id" {{ $sortBy == 'id' ? 'selected' : '' }}>ID (Selisih Input)</option>
                </select>
            </div>
            <div class="col-md-4">
                <select name="sort_order" class="form-select">
                    <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Sortir</button>
            </div>
        </div>
    </form>

    <!-- Form untuk checkbox dan pindah ke laku -->
    <form action="{{ route('laptop.markSold') }}" method="POST">
        @csrf
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Selisih Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laptops as $laptop)
                    <tr>
                        <td><input type="checkbox" name="laptop_ids[]" value="{{ $laptop->id }}"></td>
                        <td>{{ $laptop->id }}</td>
                        <td>{{ $laptop->brand }}</td>
                        <td>{{ $laptop->model }}</td>
                        <td>{{ number_format($laptop->price, 0, ',', '.') }}</td>
                        <td>{{ number_format($laptop->selling_price, 0, ',', '.') }}</td>
                        <td>{{ number_format($laptop->selling_price - $laptop->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="/laptop/edit/{{ $laptop->id }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="/laptop/delete/{{ $laptop->id }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Pindahkan ke Laku</button>
    </form>

</div>

</body>
</html>
