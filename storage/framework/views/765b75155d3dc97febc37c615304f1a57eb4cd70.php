<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
    <?php echo Form::label('name', 'Name', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('bio') ? 'has-error' : ''); ?>">
    <?php echo Form::label('bio', 'Bio', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::textarea('bio', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('bio', '<p class="help-block">:message</p>'); ?>

    </div>
</div>
<div class="form-group <?php echo e($errors->has('url') ? 'has-error' : ''); ?>">
    <?php echo Form::label('url', 'Url', ['class' => 'col-md-4 control-label']); ?>

    <div class="col-md-6">
        <?php echo Form::file('url', null, ['class' => 'form-control']); ?>

        <?php echo $errors->first('url', '<p class="help-block">:message</p>'); ?>

    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <?php echo Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']); ?>

    </div>
</div>