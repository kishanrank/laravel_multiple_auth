<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Admin::orderBy('id', 'DESC')->paginate(5);
        return view('admin.admins.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
            'roles' => 'required'
        ]);
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        $admin = Admin::create($input);
        $admin->assignRole($request->input('roles'));
        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin created successfully');
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        return view('admin.admins.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $adminRole = $admin->roles->pluck('name', 'name')->all();
        return view('admin.admins.edit', compact('admin', 'roles', 'adminRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required'
        ]);
        $input = $request->all();
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $admin->assignRole($request->input('roles'));
        return redirect()->route('admin.admins.index')
            ->with('success', 'admin updated successfully');
    }

    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin deleted successfully');
    }
}
