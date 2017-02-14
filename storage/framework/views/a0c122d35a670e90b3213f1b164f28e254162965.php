

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Album <?php echo e($album->id); ?></div>
                    <div class="panel-body">

                        <?php if($errors->any()): ?>
                            <ul class="alert alert-danger">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </ul>
                        <?php endif; ?>

                        <?php echo Form::model($album, [
                            'method' => 'PATCH',
                            'url' => ['/admin/albums', $album->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]); ?>


                        <?php echo $__env->make('admin.albums.form', ['submitButtonText' => 'Update'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>