
<?php $__env->startSection('content'); ?>
<div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Data Warehouse</h5>
                <div class="card-body">
                    <form action="<?php echo e(route('warehouse.update',['id'=>$warehouse->id])); ?>" method="POST" enctype="multipart/form-data" >
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="name_warehouse" class="form-label">Nama Warehouse</label>
                            <input type="text" class="form-control" id="name_warehouse" name="name_warehouse"
                                value="<?php echo e($warehouse->name_warehouse); ?>" required>
                            <?php $__errorArgs = ['name_warehouse'];
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

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Warehouse</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="<?php echo e($warehouse->address); ?>" required>
                            <?php $__errorArgs = ['address'];
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


                        <div class="mb-3">
                            <label for="pic" class="form-label">PIC</label>
                            <input type="text" class="form-control" id="pic" name="pic"
                                value="<?php echo e($warehouse->pic); ?>" required>
                            <?php $__errorArgs = ['pic'];
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


                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact"
                                value="<?php echo e($warehouse->contact); ?>" required>
                            <?php $__errorArgs = ['contact'];
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
                            <a href="<?php echo e(route('warehouse.index')); ?>" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pos-laravel-server\resources\views/warehouse/edit-warehouse.blade.php ENDPATH**/ ?>