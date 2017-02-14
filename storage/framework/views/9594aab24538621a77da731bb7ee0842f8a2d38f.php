<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Request <?php echo e($request->id); ?></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td><?php echo e($request->id); ?></td>
                                    </tr>
                                     <tr><th> Title </th>
                                     <td> <?php echo e($request->title); ?> </td>
                                    </tr><tr><th> Artist </th>
                                    <td> <?php echo e($request->artist); ?> </td>
                                    </tr><tr><th> Content </th>
                                    <td> <?php echo html_entity_decode($request->content); ?></td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>