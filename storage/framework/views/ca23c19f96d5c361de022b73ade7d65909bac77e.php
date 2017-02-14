<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Feedback</div>
                    <div class="panel-body">
                      <!--   <a href="<?php echo e(url('/admin/feedback/create')); ?>" class="btn btn-primary btn-xs" title="Add New Feedback"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a> -->
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Title </th>
                                        <th> Content </th>
                                        <th> Status </th>
                                        <th> Created </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $feedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                         <td><?php echo e($item->id); ?></td>
                                         <td><?php echo e($item->title); ?></td>
                                         <td><?php echo e($item->content); ?></td>
                                         <td>
                                         <?php if($item->status == 0): ?> 
                                          <span class="label label-danger"> Unread </span> 
                                           <?php else: ?>  <span class="label label-success"> Read </span>
                                         <?php endif; ?>
                                         </td>
                                         <td><?php echo  date('F j, Y, h:i:s A', strtotime($item->created_at)); ?> </td>
                                        <td>
                                            <a href="<?php echo e(url('/admin/feedback/' . $item->id)); ?>" class="btn btn-success btn-xs" title="View Feedback"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> <?php echo $feedback->render(); ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>