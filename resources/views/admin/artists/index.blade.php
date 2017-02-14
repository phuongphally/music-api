@extends('layouts.app')

@section('content')

 @if(Session::has('flash_message'))
    <div class="alert-box {{ Session::get('flash_class') }} pos-top" >
     <a href="#" class="close">&times;</a>
        <span> {{ Session::get('flash_message') }} </span>
    </div>
@endif
    
    <div class="container">
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">Artists</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/artists/create') }}" class="btn btn-primary btn-xs" title="Add New Artist"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Profile </th>
                                        <th> Name </th>
                                        <th> Bio </th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($artists as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                         <td><img src="{{ $item->url }}" alt="{{ $item->name }}" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->bio }}</td>
                                        <td>
                                            <a href="{{ url('/admin/artists/' . $item->id) }}" class="btn btn-success btn-xs" title="View Artist"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/artists/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Artist"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/artists', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Artist" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Artist',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $artists->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection