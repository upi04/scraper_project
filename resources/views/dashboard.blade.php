<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #1f1c2c, #928dab);
            color: #fff;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .navbar {
            margin-bottom: 40px;
        }
    </style>
</head>
<body class="bg-light">

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

<!-- Content -->
<div class="container text-center">
    <h2 class="mb-4">Selamat Datang di Dashboard Penjualan Laptop</h2>
    <p class="lead mb-5">Kelola data penjualan laptop Anda dengan mudah dan efisien 🚀</p>

    <!-- Cards Statistik -->
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card bg-primary text-white p-4">
                <h4>Total Laptop</h4>
                <h2>{{ $totalLaptop ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white p-4">
                <h4>Laptop Terjual Bulan Ini</h4>
                <h2>{{ $totalLaptopSold ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark p-4">
                <h4>Total Profit Bulan Ini</h4>
                <h2>Rp {{ number_format($totalProfit ?? 0, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
