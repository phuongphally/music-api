<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo e($page[0]->title); ?></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                    <th>ID</th>
                                    <td><?php echo e($page[0]->id); ?></td>
                                    </tr>
                                    <tr><th> Title </th><td> <?php echo e($page[0]->title); ?> </td></tr>
                                    <tr><th> Content </th>
                                    <td> <?php echo html_entity_decode($page[0]->content); ?> </td>
                                    </tr>
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