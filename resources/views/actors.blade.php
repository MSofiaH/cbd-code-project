@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" layout="row">
                    <div class="header">Actors</div>
                
                </div>
                <div class="card-body">
                    <actors-component></actors-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
