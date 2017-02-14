@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Request {{ $request->id }}</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $request->id }}</td>
                                    </tr>
                                     <tr><th> Title </th>
                                     <td> {{ $request->title }} </td>
                                    </tr><tr><th> Artist </th>
                                    <td> {{ $request->artist }} </td>
                                    </tr><tr><th> Content </th>
                                    <td> {!!html_entity_decode($request->content)!!}</td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection