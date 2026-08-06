@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

@if(session('errors'))
<div class="alert alert-danger">
    {{ session('errors') }}
</div>
@endif

<h1>🛒 Halaman Penjualan</h1>

<div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('penjualan.index') }}" method="GET" style="max-width: 400px; width: 100%;">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request()->search }}"
                class="form-control"
                placeholder="Cari penjualan...">
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>

    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">+ Create Penjualan</a>
</div>

<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Total</th>
            <th>Metode</th>
            <th>Status</th>
            <th width="220">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($sales as $sale)

        <tr>

            <th scope="row">{{ $sales->firstItem()+$loop->index }}</th>

            <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>

            <td>{{ $sale->user->name }}</td>

            <td>
                <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>
            </td>

            <td>{{ $sale->metode_pembayaran }}</td>

            <td>
                @if($sale->status=='OPEN')
                    <span class="badge-open">OPEN</span>
                @else
                    <span class="badge-complete">COMPLETED</span>
                @endif
            </td>

            <td class="text-nowrap">

                <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-info btn-sm">
                    Detail
                </a>

                @can('view',$sale)
                <a href="{{ route('penjualan.edit',$sale) }}" class="btn btn-warning btn-sm">
                    ✏
                </a>
                @endcan

                @can('delete',$sale)
                <form action="{{ route('penjualan.destroy',$sale) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                        🗑
                    </button>
                </form>
                @endcan

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="7">
                <h4 class="text-center my-3">Data tidak tersedia.</h4>
            </td>
        </tr>

        @endforelse

    </tbody>
</table>
</div>

<div class="mt-3">
    {{ $sales->links() }}
</div>

<style>

/* Background halaman - Sama persis dengan Produk */
body{
    background:linear-gradient(135deg,#eef6ff,#dbeafe);
    min-height:100vh;
}

/* Judul - Sama persis dengan Produk */
h1{
    color:#3b82f6;
    font-weight:700;
    margin-bottom:20px;
}

/* Tombol Create - Sama persis dengan Produk */
.btn-primary{
    background:#6ea8fe;
    border:none;
    border-radius:25px;
    padding:10px 25px;
    box-shadow:0 5px 15px rgba(110,168,254,.3);
    transition:.3s;
    color:white;
}

.btn-primary:hover{
    background:#4f8cff;
    color:white;
    transform:translateY(-2px);
}

/* Search Input - Sama persis dengan Produk */
.input-group{
    background:white;
    padding:5px;
    border-radius:30px;
    box-shadow:0 5px 20px rgba(100,150,255,.15);
}

.input-group .form-control{
    border:none;
    border-radius:25px 0 0 25px;
    padding:12px 20px;
}

.input-group .form-control:focus{
    box-shadow:none;
}

.btn-outline-secondary{
    border:none;
    background:#e0edff;
    color:#3b82f6;
    border-radius:0 25px 25px 0;
    padding:10px 25px;
}

.btn-outline-secondary:hover{
    background:#6ea8fe;
    color:white;
}

/* Table - Sama persis dengan Produk */
.table-responsive{
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(59,130,246,.15);
}

.table{
    background:white;
    margin-bottom:0;
}

.table thead{
    background:#dbeafe;
    color:#2563eb;
}

.table thead th{
    padding:15px;
}

.table tbody td,
.table tbody th{
    padding:10px 15px;
    vertical-align:middle;
}

.table tbody tr{
    transition:.3s;
}

.table tbody tr:hover{
    background:#f0f7ff;
}

/* Badge Status */
.badge-open{
    background:#fff3cd;
    color:#856404;
    padding:5px 12px;
    border-radius:20px;
    font-size:0.85rem;
    font-weight:600;
}

.badge-complete{
    background:#d1fae5;
    color:#065f46;
    padding:5px 12px;
    border-radius:20px;
    font-size:0.85rem;
    font-weight:600;
}

/* Tombol Aksi - Sama persis dengan Produk */
.btn-info{
    background:#e0edff;
    border:none;
    color:#3b82f6;
    border-radius:20px;
    padding:6px 16px;
}

.btn-info:hover{
    background:#6ea8fe;
    color:white;
}

.btn-warning{
    background:#93c5fd;
    border:none;
    color:white;
    border-radius:20px;
    padding:6px 16px;
}

.btn-warning:hover{
    background:#60a5fa;
    color:white;
}

.btn-danger{
    border-radius:20px;
    padding:6px 16px;
}

/* Pagination - Sama persis dengan Produk */
.pagination{
    margin-top:20px;
}

.pagination .page-link{
    color:#3b82f6;
    border-radius:10px;
    margin:0 3px;
}

.pagination .active .page-link{
    background:#6ea8fe;
    border-color:#6ea8fe;
}

</style>

@endsection