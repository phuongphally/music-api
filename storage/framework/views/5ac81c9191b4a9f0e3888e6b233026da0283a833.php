<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Page <?php echo e($page->id); ?></div>
                    <div class="panel-body">

                        <a href="<?php echo e(url('admin/pages/' . $page->id . '/edit')); ?>" class="btn btn-primary btn-xs" title="Edit Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                       
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td><?php echo e($page->id); ?></td>
                                    </tr>
                                    <tr><th> Title </th><td> <?php echo e($page->title); ?> </td></tr>
                                    <tr><th> Content </th>
                                    <td> <?php echo html_entity_decode($page->content); ?> </td>
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