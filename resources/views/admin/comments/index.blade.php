@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Comments</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Artist </th>
                                        <th> User Profile</th>
                                        <th> User </th>
                                        <th> Content </th>
                                        <th> Created </th>
                                       <!--  <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->author }}</td>
                                        <td><img src="{{ $item->thumb }}" alt="{{ $item->name }}" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->content }}</td>
                                         <td>{{ $item->created_at }}</td>
                                      <!--   <td> -->
                                          <!--   <a href="{{ url('/api/comments/' . $item->id) }}" class="btn btn-success btn-xs" title="View Comment"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a> -->
                                            <!-- <a href="{{ url('/api/comments/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Comment"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a> -->
                                            <!-- {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/api/comments', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!} -->
                                                <!-- {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Comment" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Comment',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!} -->
                                           <!--  {!! Form::close() !!} -->
                                       <!--  </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $comments->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection