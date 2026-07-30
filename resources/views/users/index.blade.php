@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<h1>Halaman Users</h1>

<a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create</a>

<form action="{{ route('admin.users') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search username or email"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Aksi</th>
    </tr>
    </thead>

    <tbody>

    @foreach ($users as $user)

    <tr>

        <td>
            {{ $users->firstItem() + $loop->index }}
        </td>

        <td>
            {{ $user->name }}
        </td>

        <td>
            {{ $user->email }}
        </td>

        <td>
            {{ $user->role->name }}
        </td>

        <td>

            <a href="{{ route('admin.users.edit', $user) }}" 
            class="btn btn-sm btn-warning">
                Edit Akun
            </a>

            ||

            <form action="{{ route('admin.users.destroy', $user) }}" 
            method="POST" 
            class="d-inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger" 
                onclick="return confirm('Yakin hapus user ini?')">
                    Hapus
                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>



<style>

/* Background */
body {
    background: linear-gradient(135deg, #eef6ff, #dbeafe);
    min-height: 100vh;
}


/* Judul */
h1 {
    color: #3b82f6;
    font-weight: 700;
    margin-bottom: 25px;
}



/* Tombol Create */
.btn-primary {
    background: #6ea8fe;
    border: none;
    border-radius: 25px;
    padding: 10px 25px;
    box-shadow: 0 5px 15px rgba(110,168,254,0.3);
    transition: 0.3s;
    margin-bottom: 20px;
}


.btn-primary:hover {
    background: #4f8cff;
    transform: translateY(-2px);
}



/* Search */
.input-group {
    background: white;
    padding: 5px;
    border-radius: 30px;
    box-shadow: 0 5px 20px rgba(100,150,255,0.15);
}


.input-group .form-control {
    border: none;
    border-radius: 25px 0 0 25px;
    padding: 12px 20px;
}


.input-group .form-control:focus {
    box-shadow: none;
}


.btn-outline-secondary {
    border: none;
    background: #dbeafe;
    color: #2563eb;
    border-radius: 0 25px 25px 0;
    padding: 10px 25px;
}


.btn-outline-secondary:hover {
    background: #6ea8fe;
    color: white;
}



/* Tabel */
.table {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(59,130,246,0.15);
}


.table thead {
    background: #dbeafe;
    color: #2563eb;
}


.table thead th {
    padding: 15px;
    font-weight: 700;
}


.table tbody td {
    padding: 15px;
    vertical-align: middle;
}


.table tbody tr {
    transition: 0.3s;
}


.table tbody tr:hover {
    background: #f0f7ff;
    transform: scale(1.01);
}



/* Tombol Edit */
.btn-warning {
    background: #93c5fd;
    border: none;
    color: white;
    border-radius: 20px;
    padding: 7px 18px;
}


.btn-warning:hover {
    background: #60a5fa;
    color: white;
}



/* Tombol Hapus */
.btn-danger {
    border-radius: 20px;
    padding: 7px 18px;
}



/* Pagination */
.pagination .page-link {
    color: #3b82f6;
}


.pagination .active .page-link {
    background: #6ea8fe;
    border-color: #6ea8fe;
}


</style>


@endsection