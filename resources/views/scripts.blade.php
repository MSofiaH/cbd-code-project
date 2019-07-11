@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" layout="row">
                    <div class="header">{{$movie_name}} - Movie Script</div>

                </div>
                <div class="card-body">
                    <scripts-component movie-id="{{$movie_id}}"></scripts-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
