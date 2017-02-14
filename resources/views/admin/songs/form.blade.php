<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('content', null, ['size' => '20x5', 'class' => 'form-control']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
    {!! Form::label('url', 'Url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('url', null, array('placeholder'=>' www.yoururl.com/link/song.mp3 ', 'class' => 'form-control')) !!}
        {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Duration', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('duration', null, array('placeholder'=>'00:00', 'class' => 'form-control')) !!}
        {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('album_id') ? 'has-error' : ''}}">
    {!! Form::label('album_id', 'Album', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select name="album_id" class="form-control m-t" required>
            <option>--- Please choose one --- </option>
              @foreach ($albums as $row)
               <option value="{{ $row->id }}">{{ $row->name }}</option>
              @endforeach
        </select>
        {!! $errors->first('album_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('artist_id') ? 'has-error' : ''}}">
    {!! Form::label('artist_id', 'Artist', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
          <select name="artist_id" class="form-control m-t" required>
             <option>--- Please choose one --- </option>
                @foreach ($artists as $row)
                  <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        {!! $errors->first('artist_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>