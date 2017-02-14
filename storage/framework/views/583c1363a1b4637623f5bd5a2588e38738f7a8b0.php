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
                    <div class="panel-heading">Songs</div>
                    <div class="panel-body">

                        <a href="<?php echo e(url('/admin/songs/create')); ?>" class="btn btn-primary btn-xs" title="Add New Song"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Artist </th>
                                        <th> Poster </th>
                                        <th> Title </th>
                                        <th> Album </th>
                                       <!--  <th> Content </th> -->
                                        <th>Duration</th>
                                        <th> Url </th>
                                        <th width="100">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?></td>
                                        <td><?php echo e($item->artist); ?></td>
                                        <td><img src="<?php echo e($item->poster); ?>" alt="<?php echo e($item->artist); ?>" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td><?php echo e($item->title); ?></td> 
                                        <td><?php echo e($item->album); ?></td>
                                        <!-- <td><?php echo e($item->content); ?></td> -->
                                        <td><?php echo e($item->duration); ?></td>
                                        <td>
                                        <audio controls>
                                          <source src="<?php echo e($item->mp3); ?>" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                        </audio>
                                        </td>
                                        <td>
                                          <a href="<?php echo e(url('/admin/songs/' . $item->id . '/edit')); ?>" class="btn btn-primary btn-xs" title="Edit Song"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            <?php echo Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/songs', $item->id],
                                                'style' => 'display:inline'
                                            ]); ?>

                                                <?php echo Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Song" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Song',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> <?php echo $songs->render(); ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>