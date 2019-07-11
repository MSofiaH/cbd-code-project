@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" layout="row">
                    <div class="header">Movies</div>
                </div>
                <div class="card-body">
                   <movies-component></movies-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
