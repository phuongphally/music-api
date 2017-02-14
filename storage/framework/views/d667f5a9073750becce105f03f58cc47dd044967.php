<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <?php echo Form::label('title', 'Title', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::text('title', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('artist') ? 'has-error' : ''); ?>">
    <?php echo Form::label('artist', 'Artist', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::text('artist', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('artist', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('src') ? 'has-error' : ''); ?>">
    <?php echo Form::label('src', 'Src', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::text('src', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('src', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('thumb') ? 'has-error' : ''); ?>">
    <?php echo Form::label('thumb', 'Artist Image', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
         <?php echo Form::file('thumb', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('thumb', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group <?php echo e($errors->has('duration') ? 'has-error' : ''); ?>">
    <?php echo Form::label('duration', 'Duration', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::text('duration', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('duration', '<p class="help-block">:message</p>'); ?>

    </div>
</div>


<div class="form-group <?php echo e($errors->has('content') ? 'has-error' : ''); ?>">
    <?php echo Form::label('content', 'Content', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::textarea('content', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('content', '<p class="help-block">:message</p>'); ?>

    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <?php echo Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']); ?>

    </div>
</div>