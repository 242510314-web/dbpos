@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<style>
    body{
        background:#f4f8ff;
    }

    .receipt-card{
        max-width:900px;
        margin:auto;
        background:#fff;
        border-radius:18px;
        box-shadow:0 8px 20px rgba(0,0,0,.08);
        overflow:hidden;
    }

    .receipt-header{
        background:#4f8ef7;
        color:#fff;
        padding:20px;
        text-align:center;
    }

    .receipt-body{
        padding:30px;
    }

    .info-table td{
        padding:6px 0;
    }

    .divider{
        border-top:2px dashed #b6c9ef;
        margin:20px 0;
    }

    .table thead{
        background:#dbeafe;
    }

    .table thead th{
        color:#1e3a8a;
        border:none;
    }

    .total-box{
        background:#eef5ff;
        border-radius:10px;
        padding:18px;
        font-size:20px;
        font-weight:bold;
        color:#1e3a8a;
    }

    .status-open{
        background:#fff3cd;
        color:#856404;
        padding:5px 12px;
        border-radius:20px;
    }

    .status-completed{
        background:#d1fae5;
        color:#065f46;
        padding:5px 12px;
        border-radius:20px;
    }
</style>

<div class="container mt-4 mb-5">

    <div class="receipt-card">

        <div class="receipt-header">
            <h2>🧾 Detail Penjualan</h2>
            <small>Sistem Point of Sale</small>
        </div>

        <div class="receipt-body">

            <table class="table table-borderless info-table">
                <tr>
                    <td width="220"><strong>ID Transaksi</strong></td>
                    <td>: {{ $penjualan->id }}</td>
                </tr>

                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>: {{ $penjualan->created_at->translatedFormat('d F Y H:i') }}</td>
                </tr>

                <tr>
                    <td><strong>Kasir</strong></td>
                    <td>: {{ $penjualan->user->name }}</td>
                </tr>

                <tr>
                    <td><strong>Metode Pembayaran</strong></td>
                    <td>: {{ $penjualan->metode_pembayaran }}</td>
                </tr>

                <tr>
                    <td><strong>Status</strong></td>
                    <td>:
                        @if($penjualan->status == 'OPEN')
                            <span class="status-open">OPEN</span>
                        @else
                            <span class="status-completed">COMPLETED</span>
                        @endif
                    </td>
                </tr>
            </table>

            <div class="divider"></div>

            <h5 class="mb-3 text-primary">
                Daftar Produk
            </h5>

            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($penjualan->itemPenjualan as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->produk->nama }}</td>

                        <td>{{ $item->kuantitas }}</td>

                        <td>
                            Rp {{ number_format($item->harga_satuan) }}
                        </td>

                        <td>
                            Rp {{ number_format($item->subtotal) }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            Tidak ada produk.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="divider"></div>

            <div class="row">

                <div class="col-md-6">
                </div>

                <div class="col-md-6">

                    <div class="total-box text-end">

                        Total Pembayaran

                        <br>

                        Rp {{ number_format($penjualan->total_pembayaran) }}

                    </div>

                </div>

            </div>

            <div class="text-center mt-4">

                <a href="{{ route('penjualan.index') }}"
                    class="btn btn-primary px-4">

                    ← Kembali

                </a>

            </div>

        </div>

    </div>

</div>

@endsection