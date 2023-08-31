
<?php $__env->startSection('content'); ?>
<div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Create Food Process</h5>
                <div class="card-body">
                    <form action="<?php echo e(route('food.process.update',['id_food_process'=>$food_process->id])); ?>" method="POST" enctype="multipart/form-data" >
                        <?php echo csrf_field(); ?>


                        <div class="mb-3">
                            <label for="bahan_dasar_id" class="form-label">Bahan Dasar</label>
                            <select name="bahan_dasar_id" id="bahan_dasar_id" class="form-control">
                              <option value="">pilih bahan dasar</option>
                              <?php $__currentLoopData = $bahan_dasars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bahan_dasar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($food_process->bahan_dasar_id == $bahan_dasar->id): ?>
                              <option value="<?php echo e($bahan_dasar->id); ?>" selected><?php echo e($bahan_dasar->nama_bahan); ?></option>
                              <?php else: ?>
                              <option value="<?php echo e($bahan_dasar->id); ?>"><?php echo e($bahan_dasar->nama_bahan); ?></option>
                              <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['bahan_dasar_id'];
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
                            <label for="satuan_id" class="form-label">Satuan</label>
                            <select name="satuan_id" id="satuan_id" class="form-control">
                              <?php $__currentLoopData = $satuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($food_process->satuan_id == $satuan->id): ?>
                              <option value="<?php echo e($satuan->id); ?>" selected><?php echo e($satuan->nama_satuan); ?></option>
                              <?php else: ?>
                              <option value="<?php echo e($satuan->id); ?>"><?php echo e($satuan->nama_satuan); ?></option>
                              <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['satuan_id'];
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
                            <label for="qty" class="form-label">Qty</label>
                            <input type="number" class="form-control" id="qty" name="qty"
                                value="<?php echo e($food_process->qty); ?>" required>
                            <?php $__errorArgs = ['qty'];
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
                            <a href="" class="btn btn-danger ms-3">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('addon-script'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
<script>
  $('#bahan_dasar_id').select2({})
  $('#satuan_id').select2({})
  $('#bahan_dasar_id').on('change',function (params) {
    getFoodData()
  })


  function getFoodData() {
    var routeUrl = "<?php echo e(route('food.data', ':index')); ?>";
            routeUrl = routeUrl.replace(':index', $('#bahan_dasar_id').val());

            $.ajax({
                url: routeUrl,
                method: 'GET',
                success: function(res) {
                    // console.log(res.harga_satuan);
                    // $('#harga_satuan').val(res.harga_satuan)
                    // getJumlahHarga()
                }
            });
  }

//   function getJumlahHarga() {
//     $('#jumlah_harga').val($('#qty').val() * $('#harga_satuan').val())
//   }

  getFoodData()

  // getJumlahHarga()

  $('#qty').on('keyup',function (params) {
    // getJumlahHarga()
  })


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pos-laravel-server\resources\views/food/food_process/edit-food-process.blade.php ENDPATH**/ ?>