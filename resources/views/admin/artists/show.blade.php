 @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Artist: {{ $artist->name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/artists/' . $artist->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Artist"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/artists', $artist->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Artist',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $artist->id }}</td>
                                    </tr>
                                     <tr><th> Name </th><td> {{ $artist->name }} </td></tr>
                                     <tr><th> Bio </th><td> {{ $artist->bio }} </td></tr>
                                     <tr><th> Url </th> 
                                     <td>
                                     <img src="{{ $artist->url }}" alt="{{ $artist->name }}" class=" img-responsive" width="50px" height="50px"></td>
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