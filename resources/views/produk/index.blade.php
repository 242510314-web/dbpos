@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>

<div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('produk.index') }}" method="GET" style="max-width: 400px; width: 100%;">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value=""
                class="form-control"
                placeholder="Search nama produk">
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>

    @can('create', App\Models\Produk::class)
    <a href="{{ route('produk.create') }}" class="btn btn-primary">Create</a>
    @endcan
</div>

<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>User</th>
        <th>Foto</th>
        <th>Nama Produk</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>

    @forelse ($products as $product)

    <tr>

        <th scope="row">
            {{ $products->firstItem() + $loop->index }}
        </th>

        <td>
            {{ $product->user->name }}
        </td>

        <td>
            <img src="{{ asset('storage/'.$product->foto) }}"
                class="product-img">
        </td>

        <td>
            {{ $product->nama }}
        </td>

        <td>
            {{ $product->harga_beli }}
        </td>

        <td>
            {{ $product->harga_jual }}
        </td>

        <td>
            {{ $product->stok }}
        </td>

        <td class="text-nowrap">

            @can('update', $product)
            <a href="{{ route('produk.edit', $product) }}"
                class="btn btn-warning btn-sm">
                ✏
            </a>
            @endcan

            @can('delete', $product)

            <form action="{{ route('produk.destroy', $product) }}"
                    method="POST"
                    class="d-inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                    🗑
                </button>

            </form>

            @endcan

        </td>

    </tr>

    @empty

    <tr>
        <td colspan="8">
            <h4 class="text-center my-3">
                Data tidak tersedia.
            </h4>
        </td>
    </tr>

    @endforelse

    </tbody>

</table>
</div>

{{ $products->links() }}

<style>

/* Background halaman */
body{
    background:linear-gradient(135deg,#eef6ff,#dbeafe);
    min-height:100vh;
}

/* Judul */
h1{
    color:#3b82f6;
    font-weight:700;
}

/* Tombol Create */
.btn-primary{
    background:#6ea8fe;
    border:none;
    border-radius:25px;
    padding:10px 25px;
    box-shadow:0 5px 15px rgba(110,168,254,.3);
    transition:.3s;
}

.btn-primary:hover{
    background:#4f8cff;
    transform:translateY(-2px);
}

/* Search */
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

/* Table */
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

/* Foto */
.product-img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:12px;
    border:2px solid #dbeafe;
    box-shadow:0 5px 15px rgba(100,150,255,.2);
}

/* Tombol */
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

/* Pagination */
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