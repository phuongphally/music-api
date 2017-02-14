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
        <?php echo Form::textarea('content', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('content', '<p class="help-block">:message</p>'); ?>

    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <?php echo Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']); ?>

    </div>
</div>