@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Album: {{ $album->name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/albums/' . $album->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Album"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/albums', $album->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Album',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $album->id }}</td>
                                    </tr>
                                    <tr><th> Name </th>
                                    <td> {{ $album->name }} </td>
                                    </tr><tr><th> Content </th>
                                     <td> {{ $album->content }} </td></tr>
                                     <tr>
                                     <th> Url </th>
                                        <td><img src="{{ $album->url }}" alt="{{ $album->name }}" class=" img-responsive" width="50px" height="50px"></td>
                                     </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection