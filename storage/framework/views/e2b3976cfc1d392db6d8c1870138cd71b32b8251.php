
<?php $__env->startSection('content'); ?>
  <h4 class="fw-bold py-3 mb-4">Data Bahan untuk Kategori <span class="btn btn-success"><?php echo e($kategori_bahan->nama_kategori_bahan); ?></span></h4>
    <div class="card">
        <div class="table-responsive text-nowrap p-4">
            <table class="table table-hover" id="table">
                <thead>
                    <tr class="text-center" style="text-align:center">
                        <th>No</th>
                        <th>bahan dasar</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="table">
                  <?php $__currentLoopData = $bahans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bahan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="text-center">
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($bahan->nama_bahan); ?></td>
                    <td>
                    <a href="<?php echo e(route('bahan.baku.kategori.bahan.edit',['id_bahan'=>$bahan->id])); ?>" class="btn btn-primary">edit</a>
                     <a href="<?php echo e(route('bahan.baku.kategori.bahan.delete',['id'=>$kategori_bahan->id,'id_bahan'=>$bahan->id])); ?>" onclick="return confirm('apakah anda yakin menghapus data ini?')" class="btn btn-danger">delete</a>
                    </td>
                 </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                  
                
                
                </tbody>
            </table>


            <a href="<?php echo e(route('bahan.baku.kategori.bahan.create',['id'=>$id])); ?>" class="btn btn-success">Add</a>
            <a href="<?php echo e(route('kategori.bahan.index')); ?>" class="btn btn-danger">Back</a>
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




<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pos-laravel-server\resources\views/kategori_bahan/bahan/index-bahan-kategori-bahan.blade.php ENDPATH**/ ?>