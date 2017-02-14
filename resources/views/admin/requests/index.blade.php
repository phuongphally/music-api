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
                    <div class="panel-heading">Requests</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/requests/create') }}" class="btn btn-primary btn-xs" title="Add New Request"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Profile </th>
                                        <th> Name </th>
                                        <th> Title </th>
                                        <th> Src </th>
                                        <th> Duration </th>
                                        <th> Status </th>
                                        <th> Created </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($requests as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                         <td><img src="{{ $item->thumb }}" alt="{{ $item->artist }}" class="img-circle img-responsive" width="50px" height="50px"></td>
                                         <td>{{ $item->artist }}</td>
                                         <td>{{ $item->title }}</td>
                                         <td>
                                        <audio controls>
                                         <source src="{{ $item->src }}" type="audio/mpeg">
                                          Your browser does not support the audio element.
                                        </audio>
                                        </td>
                                         <td>{{ $item->duration }}</td>
                                        <td>
                                         @if ($item->status == 0) 
                                          <span class="label label-danger"> Unread </span> 
                                           @else  <span class="label label-success"> Read </span>
                                         @endif
                                         </td>
                                         <td><?php echo  date('F j, Y, h:i:s A', strtotime($item->created_at)); ?></td>
                                         <td>
                                            <a href="{{ url('/admin/requests/' . $item->id) }}" class="btn btn-success btn-xs" title="View Request"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            
                                            <a href="{{ url('/admin/requests/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Request"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>

                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/requests', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Request" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Request',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $requests->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection