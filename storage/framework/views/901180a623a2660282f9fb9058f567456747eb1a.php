<?php $__env->startSection('content'); ?>

 <?php if(Session::has('flash_message')): ?>
    <div class="alert-box <?php echo e(Session::get('flash_class')); ?> pos-top" >
     <a href="#" class="close">&times;</a>
        <span> <?php echo e(Session::get('flash_message')); ?> </span>
    </div>
<?php endif; ?>



    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Pages</div>
                    <div class="panel-body">
                        <a href="<?php echo e(url('/admin/pages/create')); ?>" class="btn btn-primary btn-xs" title="Add New Page"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Title </th>
                                        <th> Slug </th>
                                        <th> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?></td>
                                        <td><?php echo e($item->title); ?></td>
                                        <td><?php echo e($item->slug); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('/admin/pages/' . $item->id)); ?>" class="btn btn-success btn-xs" title="View Page"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="<?php echo e(url('/admin/pages/' . $item->id . '/edit')); ?>" class="btn btn-primary btn-xs" title="Edit Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> <?php echo $pages->render(); ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>