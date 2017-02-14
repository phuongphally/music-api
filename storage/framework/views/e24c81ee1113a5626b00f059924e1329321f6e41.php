<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Comments</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Artist </th>
                                        <th> User Profile</th>
                                        <th> User </th>
                                        <th> Content </th>
                                        <th> Created </th>
                                       <!--  <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?></td>
                                        <td><?php echo e($item->author); ?></td>
                                        <td><img src="<?php echo e($item->thumb); ?>" alt="<?php echo e($item->name); ?>" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td><?php echo e($item->name); ?></td>
                                        <td><?php echo e($item->content); ?></td>
                                         <td><?php echo e($item->created_at); ?></td>
                                      <!--   <td> -->
                                          <!--   <a href="<?php echo e(url('/api/comments/' . $item->id)); ?>" class="btn btn-success btn-xs" title="View Comment"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a> -->
                                            <!-- <a href="<?php echo e(url('/api/comments/' . $item->id . '/edit')); ?>" class="btn btn-primary btn-xs" title="Edit Comment"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a> -->
                                            <!-- <?php echo Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/api/comments', $item->id],
                                                'style' => 'display:inline'
                                            ]); ?> -->
                                                <!-- <?php echo Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Comment" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Comment',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )); ?> -->
                                           <!--  <?php echo Form::close(); ?> -->
                                       <!--  </td> -->
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> <?php echo $comments->render(); ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>