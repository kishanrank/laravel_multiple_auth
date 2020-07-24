@extends('layouts.app')
@section('content')
<div class="col-lg-10 margin-tb">
    <div class="pull-left">
        <h2>Permission</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('admin.permissions.create') }}"> Create New Permission</a>
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
            <th width="280px">Action</th>
        </tr>
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $permission->name }}</td>
            <td>
                <form action="{{ route('admin.permissions.destroy',$permission->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('admin.permissions.edit',$permission->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
{!! $permissions->links() !!}
</div>
@endsection