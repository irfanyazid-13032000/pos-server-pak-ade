<?php echo e(Form::open(['url' => 'product_tax', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <?php echo e(Form::label('tax_name', __('Tax Name'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::text('tax_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Tax Name'), 'required' => 'required'])); ?>

                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <?php echo e(Form::label('rate', __('Rate') . ' ' . '(%)', ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::number('rate', null, ['class' => 'form-control', 'placeholder' => __('Enter Rate'), 'required' => 'required'])); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <button type="submit" class="btn  btn-primary"><?php echo e(__('Save')); ?></button>
    </div>
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH C:\laragon\www\pos-laravel-server\resources\views/producttax/create.blade.php ENDPATH**/ ?>