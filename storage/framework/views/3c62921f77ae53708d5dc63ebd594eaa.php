

<?php $__env->startSection('title', 'Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(session('errors')): ?>
<div class="alert alert-danger">
    <?php echo e(session('errors')); ?>

</div>
<?php endif; ?>

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

        <a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-soft-primary">
            + Create Penjualan
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-body">

            <form action="<?php echo e(route('penjualan.index')); ?>" method="GET" class="mb-4">
                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        value="<?php echo e(request()->search); ?>"
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

                        <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td><?php echo e($sales->firstItem()+$loop->index); ?></td>

                            <td><?php echo e($sale->created_at->translatedFormat('d-m-Y H:i:s')); ?></td>

                            <td><?php echo e($sale->user->name); ?></td>

                            <td>
                                <strong class="text-primary">
                                    Rp <?php echo e(number_format($sale->total_pembayaran)); ?>

                                </strong>
                            </td>

                            <td><?php echo e($sale->metode_pembayaran); ?></td>

                            <td>

                                <?php if($sale->status=='OPEN'): ?>

                                    <span class="badge-open">
                                        OPEN
                                    </span>

                                <?php else: ?>

                                    <span class="badge-complete">
                                        COMPLETED
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a href="<?php echo e(route('penjualan.show', $sale)); ?>" class="btn btn-info">
    Detail
</a>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view',$sale)): ?>

                                    <a href="<?php echo e(route('penjualan.edit',$sale)); ?>"
                                        class="btn btn-warning btn-sm btn-action">
                                        Edit
                                    </a>

                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',$sale)): ?>

                                    <form action="<?php echo e(route('penjualan.destroy',$sale)); ?>"
                                        method="POST">

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            class="btn btn-danger btn-sm btn-action"
                                            onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">

                                            Hapus

                                        </button>

                                    </form>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="7" class="text-center text-muted py-4">
                                Tidak ada data penjualan.
                            </td>

                        </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                <?php echo e($sales->links()); ?>

            </div>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\dbpos\resources\views/penjualan/index.blade.php ENDPATH**/ ?>