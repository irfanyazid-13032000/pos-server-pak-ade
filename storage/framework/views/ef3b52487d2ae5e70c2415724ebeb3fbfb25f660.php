
<?php $__env->startSection('content'); ?>
<div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Data Satuan</h5>
                <div class="card-body">
                    <form action="<?php echo e(route('satuan.store')); ?>" method="POST" enctype="multipart/form-data" >
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label for="nama_satuan" class="form-label">Nama Satuan</label>
                            <input type="text" class="form-control" id="nama_satuan" name="nama_satuan"
                                value="<?php echo e(old('nama_satuan')); ?>" required>
                        </div>


                       
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a href="" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pos-laravel-server\resources\views/satuan/create-satuan.blade.php ENDPATH**/ ?>