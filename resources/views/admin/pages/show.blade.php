@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $page[0]->title }}</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                    <th>ID</th>
                                    <td>{{ $page[0]->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $page[0]->title }} </td></tr>
                                    <tr><th> Content </th>
                                    <td> {!!html_entity_decode($page[0]->content)!!} </td>
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