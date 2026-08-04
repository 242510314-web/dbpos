@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

@if(session('errors'))
<div class="alert alert-danger">
    {{ session('errors') }}
</div>
@endif

<style>
    body{
        background:#f4f8ff;
    }

    .page-title{
        color:#1e3a8a;
        font-weight:700;
    }

    .card-custom{
        border:none;
        border-radius:15px;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
    }

    .btn-soft-primary{
        background:#4f8ef7;
        color:white;
        border:none;
    }

    .btn-soft-primary:hover{
        background:#3b7be3;
        color:white;
    }

    .table thead{
        background:#dbeafe;
    }

    .table thead th{
        color:#1e3a8a;
        font-weight:600;
        border:none;
    }

    .table tbody tr:hover{
        background:#f1f7ff;
    }

    .badge-open{
        background:#fff3cd;
        color:#856404;
        padding:7px 12px;
        border-radius:20px;
    }

    .badge-complete{
        background:#d1fae5;
        color:#065f46;
        padding:7px 12px;
        border-radius:20px;
    }

    .btn-action{
        border-radius:10px;
        padding:6px 15px;
    }

    .search-box{
        border-radius:10px;
    }
</style>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">🛒 Halaman Penjualan</h2>

        <a href="{{ route('penjualan.create') }}" class="btn btn-soft-primary">
            + Create Penjualan
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-body">

            <form action="{{ route('penjualan.index') }}" method="GET" class="mb-4">
                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        value="{{ request()->search }}"
                        class="form-control search-box"
                        placeholder="Cari penjualan..."
                    >

                    <button class="btn btn-soft-primary">
                        🔍 Search
                    </button>

                </div>
            </form>

            <div class="table-responsive">

                <table class="table align-middle">

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

                            <td>{{ $sales->firstItem()+$loop->index }}</td>

                            <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>

                            <td>{{ $sale->user->name }}</td>

                            <td>
                                <strong class="text-primary">
                                    Rp {{ number_format($sale->total_pembayaran) }}
                                </strong>
                            </td>

                            <td>{{ $sale->metode_pembayaran }}</td>

                            <td>

                                @if($sale->status=='OPEN')

                                    <span class="badge-open">
                                        OPEN
                                    </span>

                                @else

                                    <span class="badge-complete">
                                        COMPLETED
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-info">
    Detail
</a>

                                    @can('view',$sale)

                                    <a href="{{ route('penjualan.edit',$sale) }}"
                                        class="btn btn-warning btn-sm btn-action">
                                        Edit
                                    </a>

                                    @endcan

                                    @can('delete',$sale)

                                    <form action="{{ route('penjualan.destroy',$sale) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm btn-action"
                                            onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">

                                            Hapus

                                        </button>

                                    </form>

                                    @endcan

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted py-4">
                                Tidak ada data penjualan.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $sales->links() }}
            </div>

        </div>
    </div>

</div>

@endsection