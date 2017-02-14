@extends('layouts.web')
@section('content')
    <div class="container" id="privacy-policy">
        <div class="row m-r m-l">
            {!!html_entity_decode($page[0]->content)!!}
        </div>
    </div>
@endsection