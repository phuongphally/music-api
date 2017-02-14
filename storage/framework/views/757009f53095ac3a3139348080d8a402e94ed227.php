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
                    <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Profile </th>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Created At </th>
                                        <th> Last logged </th>
                                       <!--  <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?></td>
                                       <td><img src="<?php echo e($item->profile); ?>" alt="<?php echo e($item->name); ?>" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td><?php echo e($item->name); ?></td>
                                        <td><?php echo e($item->email); ?></td>
                                        <td><?php echo e($item->created_at); ?></td>
                                        <td><span class="label label-success"> <?php echo  date('F j, Y, h:i:s A', strtotime($item->last_login)); ?> </span> </td>
                                      <!--   <td> </td> -->
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> <?php echo $users->render(); ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>