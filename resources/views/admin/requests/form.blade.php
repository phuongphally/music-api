<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('artist') ? 'has-error' : ''}}">
    {!! Form::label('artist', 'Artist', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('artist', null, ['class' => 'form-control']) !!}
        {!! $errors->first('artist', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('src') ? 'has-error' : ''}}">
    {!! Form::label('src', 'Src', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('src', null, ['class' => 'form-control']) !!}
        {!! $errors->first('src', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('thumb') ? 'has-error' : ''}}">
    {!! Form::label('thumb', 'Artist Image', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
         {!! Form::file('thumb', null, ['class' => 'form-control']) !!}
        {!! $errors->first('thumb', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Duration', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('duration', null, ['class' => 'form-control']) !!}
        {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>