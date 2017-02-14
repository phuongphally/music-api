<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('bio') ? 'has-error' : ''}}">
    {!! Form::label('bio', 'Bio', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('bio', null, ['class' => 'form-control']) !!}
        {!! $errors->first('bio', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
    {!! Form::label('url', 'Url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>