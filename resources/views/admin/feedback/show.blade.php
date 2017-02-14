@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">Feedback {{ $feedback->id }}</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $feedback->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $feedback->title }} </td>
                                    </tr><tr><th> Content </th><td> {{ $feedback->content }} </td>
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