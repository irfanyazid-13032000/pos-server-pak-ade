
<?php $__env->startSection('content'); ?>
  <h4 class="fw-bold py-3 mb-4">Data Resep <span class="btn btn-success"><?php echo e($food->nama_menu); ?></span></h4>
    <div class="card">
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center" style="text-align:center">
                        <th>No</th>
                        <th>bahan dasar</th>
                        <th>satuan</th>
                        <th>qty</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                  <?php $__currentLoopData = $foods_process; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $makanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="text-center">
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($makanan->nama_bahan); ?></td>
                    <td><?php echo e($makanan->nama_satuan); ?></td>
                    <td><?php echo e($makanan->qty); ?></td>
                    <td>
                    <a href="<?php echo e(route('food.process.edit',['id_food_process'=>$makanan->id])); ?>" class="btn btn-primary">edit</a>
                     <a href="<?php echo e(route('food.process.delete',['id_food_process'=>$makanan->id])); ?>" class="btn btn-danger">delete</a>
                    </td>
                 </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <!-- <tr>
                    <th colspan="8"></th>
                  </tr>
                  <tr>
                    <th colspan="5"></th>
                    <th style="text-align:center;">All Total Price</th>
                    <th></th>
                  </tr>
                  <tr>
                    <th colspan="5"></th>
                    <th style="text-align:center;">Rp. <?php echo e(number_format($totalPrice)); ?></th>
                    <th></th>
                  </tr>
                  <tr>
                    <th colspan="5"></th>
                    <th style="text-align:center;">Porsi : <?php echo e($food->porsi); ?></th>
                    <th></th>
                  </tr>
                  <tr>

                    <th colspan="5"></th>
                    <th style="text-align:center;">Harga per Porsi : Rp. <?php echo e(number_format($totalPrice/$food->porsi)); ?></th>
                    <th></th>
                  </tr> -->
                  
                
                
                </tbody>
            </table>


            <a href="<?php echo e(route('food.process.create',['id'=>$id])); ?>" class="btn btn-success">Add</a>
            <a href="<?php echo e(route('food.index')); ?>" class="btn btn-danger">Back</a>
        </div>
    </div>

    
    
<?php $__env->stopSection(); ?>


<?php $__env->startPush('addon-script'); ?>
    <script src="<?php echo e(url('https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js')); ?>"></script>
    <script>
      $('#table').DataTable({
    columnDefs: [
        {
            targets: '_all', // Kolom terakhir
            className: 'dt-center' // Membuat semua sel dalam kolom menjadi berpusat
        },
        
    ]
});

    </script>
<?php $__env->stopPush(); ?>




<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pos-laravel-server\resources\views/food/food_process/index-food-process.blade.php ENDPATH**/ ?>