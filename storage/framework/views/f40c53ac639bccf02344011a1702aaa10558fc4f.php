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
                    <div class="panel-heading">Requests</div>
                    <div class="panel-body">

                        <a href="<?php echo e(url('/admin/requests/create')); ?>" class="btn btn-primary btn-xs" title="Add New Request"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Profile </th>
                                        <th> Name </th>
                                        <th> Title </th>
                                        <th> Src </th>
                                        <th> Duration </th>
                                        <th> Status </th>
                                        <th> Created </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?></td>
                                         <td><img src="<?php echo e($item->thumb); ?>" alt="<?php echo e($item->artist); ?>" class="img-circle img-responsive" width="50px" height="50px"></td>
                                         <td><?php echo e($item->artist); ?></td>
                                         <td><?php echo e($item->title); ?></td>
                                         <td>
                                        <audio controls>
                                         <source src="<?php echo e($item->src); ?>" type="audio/mpeg">
                                          Your browser does not support the audio element.
                                        </audio>
                                        </td>
                                         <td><?php echo e($item->duration); ?></td>
                                        <td>
                                         <?php if($item->status == 0): ?> 
                                          <span class="label label-danger"> Unread </span> 
                                           <?php else: ?>  <span class="label label-success"> Read </span>
                                         <?php endif; ?>
                                         </td>
                                         <td><?php echo  date('F j, Y, h:i:s A', strtotime($item->created_at)); ?></td>
                                         <td>
                                            <a href="<?php echo e(url('/admin/requests/' . $item->id)); ?>" class="btn btn-success btn-xs" title="View Request"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            
                                            <a href="<?php echo e(url('/admin/requests/' . $item->id . '/edit')); ?>" class="btn btn-primary btn-xs" title="Edit Request"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>

                                            <?php echo Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/requests', $item->id],
                                                'style' => 'display:inline'
                                            ]); ?>

                                                <?php echo Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Request" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Request',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> <?php echo $requests->render(); ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>