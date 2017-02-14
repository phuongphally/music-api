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
                    <div class="panel-heading">Songs</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/songs/create') }}" class="btn btn-primary btn-xs" title="Add New Song"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Artist </th>
                                        <th> Poster </th>
                                        <th> Title </th>
                                        <th> Album </th>
                                       <!--  <th> Content </th> -->
                                        <th>Duration</th>
                                        <th> Url </th>
                                        <th width="100">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($songs as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->artist }}</td>
                                        <td><img src="{{ $item->poster }}" alt="{{ $item->artist }}" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td>{{ $item->title }}</td> 
                                        <td>{{ $item->album }}</td>
                                        <!-- <td>{{ $item->content }}</td> -->
                                        <td>{{ $item->duration }}</td>
                                        <td>
                                        <audio controls>
                                          <source src="{{ $item->mp3 }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                        </audio>
                                        </td>
                                        <td>
                                          <a href="{{ url('/admin/songs/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Song"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/songs', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Song" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Song',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $songs->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection