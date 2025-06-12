<!DOCTYPE html>
<html>
<head>
    <title>Input Data Laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<script>
function formatRupiah(input) {
    let value = input.value.replace(/[^\d]/g, ""); // Hilangkan semua selain angka
    if (!value) {
        input.value = "";
        return;
    }

    let formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value);

    input.value = formatted.replace("Rp", "Rp "); // Tambahkan spasi jika perlu
}
</script>

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
    <h2 class="text-center mb-4">Input Data Laptop</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<form method="POST" action="/laptop/input">
    @csrf
    <div class="mb-3">
        <label>Brand</label>
        <input type="text" name="brand" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Model</label>
        <input type="text" name="model" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Harga Beli</label>
    <input type="text" name="price" class="form-control" required oninput="formatRupiah(this)" placeholder="Rp 0">
</div>
<div class="mb-3">
    <label>Harga Jual</label>
    <input type="text" name="selling_price" class="form-control" required oninput="formatRupiah(this)" placeholder="Rp 0">
</div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>

</body>
</html>
