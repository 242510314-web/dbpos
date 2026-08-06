

<?php $__env->startSection('title', 'Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(session('errors')): ?>
<div class="alert alert-danger">
    <?php echo e(session('errors')); ?>

</div>
<?php endif; ?>

<h1>🛒 Halaman Penjualan</h1>

<div class="d-flex justify-content-between align-items-center mb-3">
    <form action="<?php echo e(route('penjualan.index')); ?>" method="GET" style="max-width: 400px; width: 100%;">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="<?php echo e(request()->search); ?>"
                class="form-control"
                placeholder="Cari penjualan...">
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>

    <a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-primary">+ Create Penjualan</a>
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

        <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <tr>

            <th scope="row"><?php echo e($sales->firstItem()+$loop->index); ?></th>

            <td><?php echo e($sale->created_at->translatedFormat('d-m-Y H:i:s')); ?></td>

            <td><?php echo e($sale->user->name); ?></td>

            <td>
                <strong>Rp <?php echo e(number_format($sale->total_pembayaran)); ?></strong>
            </td>

            <td><?php echo e($sale->metode_pembayaran); ?></td>

            <td>
                <?php if($sale->status=='OPEN'): ?>
                    <span class="badge-open">OPEN</span>
                <?php else: ?>
                    <span class="badge-complete">COMPLETED</span>
                <?php endif; ?>
            </td>

            <td class="text-nowrap">

                <a href="<?php echo e(route('penjualan.show', $sale)); ?>" class="btn btn-info btn-sm">
                    Detail
                </a>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view',$sale)): ?>
                <a href="<?php echo e(route('penjualan.edit',$sale)); ?>" class="btn btn-warning btn-sm">
                    ✏
                </a>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',$sale)): ?>
                <form action="<?php echo e(route('penjualan.destroy',$sale)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                        🗑
                    </button>
                </form>
                <?php endif; ?>

            </td>

        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <tr>
            <td colspan="7">
                <h4 class="text-center my-3">Data tidak tersedia.</h4>
            </td>
        </tr>

        <?php endif; ?>

    </tbody>
</table>
</div>

<div class="mt-3">
    <?php echo e($sales->links()); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\dbpos\resources\views/penjualan/index.blade.php ENDPATH**/ ?>