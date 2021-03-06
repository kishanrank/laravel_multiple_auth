@extends('layouts.app')
@section('content')
<div class="col-lg-10 margin-tb">
    <div class="pull-left">
        <h2> Show Role</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('admin.roles.index') }}"> Back</a>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                <label class="label label-success">{{ $v->name }},</label>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection