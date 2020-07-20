@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-2">
        <ul>
            <li><a href="/admin/dashboard">Home</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Roles</a></li>
            <li><a href="#">Permission</a></li>
        </ul>
    </div>
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
</div>
@endsection