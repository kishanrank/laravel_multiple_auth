@extends('layouts.app')
@section('content')
<div class="col-lg-10 margin-tb">
    <div class="pull-left">
        <h2>Admin Management</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('admin.admins.create') }}"> Create New admin</a>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $admin)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
            <td>
                @if(!empty($admin->getRoleNames()))
                @foreach($admin->getRoleNames() as $v)
                <label class="badge badge-success">{{ $v }}</label>
                @endforeach
                @endif
            </td>
            <td>
                <a class="btn btn-info" href="{{ route('admin.admins.show',$admin->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('admin.admins.edit',$admin->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['admin.admins.destroy', $admin->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>
</div>
{!! $data->render() !!}
@endsection