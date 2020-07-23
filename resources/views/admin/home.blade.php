@extends('layouts.app')
@section('content')

<div class="col-lg-10">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>
                    <div class="card-body">{{ Auth::user()->name }}You are logged in!</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection