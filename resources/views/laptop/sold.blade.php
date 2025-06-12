<!DOCTYPE html>
<html>
<head>
    <title>Daftar Laptop Terjual</title>
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
    <h2 class="text-center mb-4">Daftar Laptop Terjual</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>Total Selisih Harga Laptop Terjual dalam 1 Bulan Terakhir: 
       <strong>Rp {{ number_format($totalSelisih ?? 0, 0, ',', '.') }}</strong>
    </p>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Selisih Harga</th>
                <th>Aksi</th>  <!-- Kolom aksi untuk tombol hapus -->
            </tr>
        </thead>
        <tbody>
            @forelse ($laptops as $index => $laptop)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laptop->brand }}</td>
                    <td>{{ $laptop->model }}</td>
                    <td>{{ number_format($laptop->price, 0, ',', '.') }}</td>
                    <td>{{ number_format($laptop->selling_price, 0, ',', '.') }}</td>
                    <td>{{ number_format($laptop->selling_price - $laptop->price, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ url('/laptop/delete/'.$laptop->id) }}" method="POST" >
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada laptop yang terjual.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="/laptop/list" class="btn btn-primary">Kembali ke Daftar Laptop</a>
</div>

</body>
</html>
