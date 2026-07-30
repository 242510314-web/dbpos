@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<style>
body{
    background:#eaf4ff;
}

/* Judul */
.dashboard-title{
    color:#2C5D91;
    font-weight:700;
}

.dashboard-subtitle{
    color:#6f89a6;
    font-size:16px;
}

/* Judul setiap section */
.section-title{
    color:#2C5D91;
    font-weight:700;
    margin:35px 0 20px;
}

/* Card Statistik */
.stat-card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    background:#ffffff;
    box-shadow:0 8px 18px rgba(125,184,244,.18);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
    box-shadow:0 12px 25px rgba(125,184,244,.25);
}

/* Header Card */
.stat-card .card-header{
    background:#BFDDFB;
    color:#2C5D91;
    font-weight:600;
    border:none;
}

/* Isi Card */
.stat-card .card-body{
    background:#ffffff;
    padding:30px;
}

.stat-number{
    color:#2C5D91;
    font-size:30px;
    font-weight:bold;
}

/* Card Tabel */
.table-card{
    background:#ffffff;
    border:1px solid #D8EAFD;
    border-radius:18px;
    box-shadow:0 8px 18px rgba(125,184,244,.15);
    padding:20px;
    margin-bottom:25px;
}

/* Table */
.table{
    margin-bottom:0;
}

.table thead{
    background:#BFDDFB;
}

.table thead th{
    color:#2C5D91;
    border:none;
}

.table tbody td{
    border-color:#eef5fd;
}

.table tbody tr:hover{
    background:#F3F9FF;
}

/* Empty text */
.empty-state{
    color:#6f89a6;
    padding:20px;
}

/* Pagination */
.pagination{
    justify-content:center;
}

.page-link{
    color:#2C5D91;
    border:1px solid #D8EAFD;
}

.page-item.active .page-link{
    background:#7DB8F4;
    border-color:#7DB8F4;
}

.page-link:hover{
    background:#BFDDFB;
    color:#2C5D91;
}

/* Bootstrap Primary Override */
.bg-primary{
    background:#7DB8F4 !important;
}

.btn-primary{
    background:#7DB8F4;
    border-color:#7DB8F4;
}

.btn-primary:hover{
    background:#69A9ED;
    border-color:#69A9ED;
}

.text-primary{
    color:#2C5D91 !important;
}
</style>

<div class="container py-4">

    <div class="text-center mb-5">
        <h1 class="dashboard-title">Dashboard POS</h1>
        <p class="dashboard-subtitle">
            Ringkasan Hari Ini
            ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
        </p>
    </div>

    @can('viewAny', App\Models\User::class)

    <h3 class="section-title text-center">Today's Sales</h3>

    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-header">
                    💰 Total Penjualan Hari Ini
                </div>
                <div class="card-body text-center">
                    <div class="stat-number">
                        Rp {{ number_format($ringkasan['total_penjualan']) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-header">
                    🧾 Jumlah Transaksi Hari Ini
                </div>
                <div class="card-body text-center">
                    <div class="stat-number">
                        {{ $ringkasan['total_transaksi'] }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <h3 class="section-title text-center">Cash & Payment Status</h3>

    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-header">
                    💵 Pembayaran Tunai
                </div>
                <div class="card-body text-center">
                    <div class="stat-number">
                        Rp {{ number_format($ringkasan['total_cash']) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-header">
                    💳 Pembayaran Non Tunai
                </div>
                <div class="card-body text-center">
                    <div class="stat-number">
                        Rp {{ number_format($ringkasan['total_non_tunai']) }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @endcan

    <h3 class="section-title text-center">Critical Inventory Status</h3>

    <div class="row">

        <div class="col-md-6">

            <div class="table-card">

                <h4 class="text-primary mb-3">
                    📦 Produk Stok Rendah
                </h4>

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($produkStokRendah as $index => $produk)

                        <tr>
                            <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="3" class="text-center empty-state">
                                ✅ Semua produk dalam kondisi stok aman.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

                {{ $produkStokRendah->links() }}

            </div>

        </div>

        <div class="col-md-6">

            <div class="table-card">

                <h4 class="text-primary mb-3">
                    ❌ Produk Habis Stok
                </h4>

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($produkStokHabis as $index => $produk)

                        <tr>
                            <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="3" class="text-center empty-state">
                                ✅ Tidak ada produk yang kehabisan stok.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

                {{ $produkStokHabis->links() }}

            </div>

        </div>

    </div>

    <h3 class="section-title text-center">🏆 Best Seller Products</h3>

    <div class="row">

        <div class="col-md-12">

            <div class="table-card">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Unit Terjual</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($produkTerlaris as $produk)

                        <tr>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ $produk->total_terjual }}</td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="3" class="text-center empty-state">
                                Belum ada data penjualan.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection