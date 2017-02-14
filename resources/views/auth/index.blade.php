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
                    <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Profile </th>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Created At </th>
                                        <th> Last logged </th>
                                       <!--  <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                       <td><img src="{{ $item->profile }}" alt="{{ $item->name }}" class="img-circle img-responsive" width="50px" height="50px"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><span class="label label-success"> <?php echo  date('F j, Y, h:i:s A', strtotime($item->last_login)); ?> </span> </td>
                                      <!--   <td> </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $users->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection