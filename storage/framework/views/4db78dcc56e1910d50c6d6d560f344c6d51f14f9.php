<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <?php echo Form::label('title', 'Title', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::text('title', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('content') ? 'has-error' : ''); ?>">
    <?php echo Form::label('content', 'Content', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::textarea('content', null, ['size' => '20x5', 'class' => 'form-control']); ?>

        <?php echo $errors->first('content', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('url') ? 'has-error' : ''); ?>">
    <?php echo Form::label('url', 'Url', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::text('url', null, array('placeholder'=>' www.yoururl.com/link/song.mp3 ', 'class' => 'form-control')); ?>

        <?php echo $errors->first('url', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('url') ? 'has-error' : ''); ?>">
    <?php echo Form::label('duration', 'Duration', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::text('duration', null, array('placeholder'=>'00:00', 'class' => 'form-control')); ?>

        <?php echo $errors->first('duration', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('album_id') ? 'has-error' : ''); ?>">
    <?php echo Form::label('album_id', 'Album', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <select name="album_id" class="form-control m-t" required>
            <option>--- Please choose one --- </option>
              <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
               <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </select>
        <?php echo $errors->first('album_id', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('artist_id') ? 'has-error' : ''); ?>">
    <?php echo Form::label('artist_id', 'Artist', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
          <select name="artist_id" class="form-control m-t" required>
             <option>--- Please choose one --- </option>
                <?php $__currentLoopData = $artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </select>
        <?php echo $errors->first('artist_id', '<p class="help-block">:message</p>'); ?>

    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <?php echo Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']); ?>

    </div>
</div>