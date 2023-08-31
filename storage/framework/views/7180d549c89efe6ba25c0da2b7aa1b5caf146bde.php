
<?php $__env->startSection('content'); ?>
<div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Data Kategori Bahan</h5>
                <div class="card-body">
                    <form action="<?php echo e(route('kategori.bahan.store')); ?>" method="POST" enctype="multipart/form-data" >
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="nama_kategori_bahan" class="form-label">Nama Kategori Bahan</label>
                            <input type="text" class="form-control" id="nama_kategori_bahan" name="nama_kategori_bahan"
                                value="<?php echo e(old('nama_kategori_bahan')); ?>" required>
                            <?php $__errorArgs = ['nama_kategori_bahan'];
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pos-laravel-server\resources\views/kategori_bahan/create-kategori-bahan.blade.php ENDPATH**/ ?>