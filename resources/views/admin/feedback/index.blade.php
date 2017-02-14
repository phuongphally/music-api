@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Feedback</div>
                    <div class="panel-body">
                      <!--   <a href="{{ url('/admin/feedback/create') }}" class="btn btn-primary btn-xs" title="Add New Feedback"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a> -->
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Title </th>
                                        <th> Content </th>
                                        <th> Status </th>
                                        <th> Created </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($feedback as $item)
                                    <tr>
                                         <td>{{ $item->id }}</td>
                                         <td>{{ $item->title }}</td>
                                         <td>{{ $item->content }}</td>
                                         <td>
                                         @if ($item->status == 0) 
                                          <span class="label label-danger"> Unread </span> 
                                           @else  <span class="label label-success"> Read </span>
                                         @endif
                                         </td>
                                         <td><?php echo  date('F j, Y, h:i:s A', strtotime($item->created_at)); ?> </td>
                                        <td>
                                            <a href="{{ url('/admin/feedback/' . $item->id) }}" class="btn btn-success btn-xs" title="View Feedback"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $feedback->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection