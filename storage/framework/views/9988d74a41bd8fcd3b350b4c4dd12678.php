

<?php $__env->startSection('title', 'Detail Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
                    <td>: <?php echo e($penjualan->id); ?></td>
                </tr>

                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>: <?php echo e($penjualan->created_at->translatedFormat('d F Y H:i')); ?></td>
                </tr>

                <tr>
                    <td><strong>Kasir</strong></td>
                    <td>: <?php echo e($penjualan->user->name); ?></td>
                </tr>

                <tr>
                    <td><strong>Metode Pembayaran</strong></td>
                    <td>: <?php echo e($penjualan->metode_pembayaran); ?></td>
                </tr>

                <tr>
                    <td><strong>Status</strong></td>
                    <td>:
                        <?php if($penjualan->status == 'OPEN'): ?>
                            <span class="status-open">OPEN</span>
                        <?php else: ?>
                            <span class="status-completed">COMPLETED</span>
                        <?php endif; ?>
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

                    <?php $__empty_1 = true; $__currentLoopData = $penjualan->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($loop->iteration); ?></td>

                        <td><?php echo e($item->produk->nama); ?></td>

                        <td><?php echo e($item->kuantitas); ?></td>

                        <td>
                            Rp <?php echo e(number_format($item->harga_satuan)); ?>

                        </td>

                        <td>
                            Rp <?php echo e(number_format($item->subtotal)); ?>

                        </td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>
                        <td colspan="5" class="text-center">
                            Tidak ada produk.
                        </td>
                    </tr>

                    <?php endif; ?>

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

                        Rp <?php echo e(number_format($penjualan->total_pembayaran)); ?>


                    </div>

                </div>

            </div>

            <div class="text-center mt-4">

                <a href="<?php echo e(route('penjualan.index')); ?>"
                    class="btn btn-primary px-4">

                    ← Kembali

                </a>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\dbpos\resources\views/penjualan/show.blade.php ENDPATH**/ ?>