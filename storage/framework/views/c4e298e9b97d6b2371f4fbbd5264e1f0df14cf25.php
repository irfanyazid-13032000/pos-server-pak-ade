
<?php $__env->startSection('content'); ?>
<div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Data Bahan Kategori Bahan</h5>
                <div class="card-body">
                    <form action="<?php echo e(route('bahan.baku.kategori.bahan.store',['id'=>$kategori_bahan->id])); ?>" method="POST" enctype="multipart/form-data" >
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="nama_bahan" class="form-label">kategoori bahan</label>
                            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan"
                                value="<?php echo e($kategori_bahan->nama_kategori_bahan); ?>" readonly>
                            <?php $__errorArgs = ['nama_bahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p style="color: rgb(253, 21, 21)"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <input type="hidden" name="kategori_bahan_id" value="<?php echo e($kategori_bahan->id); ?>">

                        <div class="mb-3">
                            <label for="nama_bahan" class="form-label">Nama  Bahan</label>
                            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan"
                                value="<?php echo e(old('nama_bahan')); ?>" required>
                            <?php $__errorArgs = ['nama_bahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p style="color: rgb(253, 21, 21)"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a href="<?php echo e(route('kategori.bahan.index')); ?>" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pos-laravel-server\resources\views/kategori_bahan/bahan/create-bahan-kategori-bahan.blade.php ENDPATH**/ ?>