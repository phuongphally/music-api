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
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Albums</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/albums/create') }}" class="btn btn-primary btn-xs" title="Add New Album"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Poster </th>
                                        <th> Name </th>
                                        <th> Content </th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($albums as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                          <td><img src="{{ $item->url }}" alt="{{ $item->name }}" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->content }}</td>
                                     
                                        <td>
                                            <a href="{{ url('/admin/albums/' . $item->id) }}" class="btn btn-success btn-xs" title="View Album"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>

                                            <a href="{{ url('/admin/albums/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Album"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                           
                                           <!--  {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/albums', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!} -->

                                                <!-- {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Album" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Album',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!} -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $albums->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection