<?php $__env->startSection('content'); ?>

 <?php if(Session::has('flash_message')): ?>
    <div class="alert-box <?php echo e(Session::get('flash_class')); ?> pos-top" >
     <a href="#" class="close">&times;</a>
        <span> <?php echo e(Session::get('flash_message')); ?> </span>
    </div>
<?php endif; ?>
    
    <div class="container">
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">Artists</div>
                    <div class="panel-body">

                        <a href="<?php echo e(url('/admin/artists/create')); ?>" class="btn btn-primary btn-xs" title="Add New Artist"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Profile </th>
                                        <th> Name </th>
                                        <th> Bio </th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?></td>
                                         <td><img src="<?php echo e($item->url); ?>" alt="<?php echo e($item->name); ?>" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td><?php echo e($item->name); ?></td>
                                        <td><?php echo e($item->bio); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('/admin/artists/' . $item->id)); ?>" class="btn btn-success btn-xs" title="View Artist"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="<?php echo e(url('/admin/artists/' . $item->id . '/edit')); ?>" class="btn btn-primary btn-xs" title="Edit Artist"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            <?php echo Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/artists', $item->id],
                                                'style' => 'display:inline'
                                            ]); ?>

                                                <?php echo Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Artist" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Artist',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> <?php echo $artists->render(); ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>