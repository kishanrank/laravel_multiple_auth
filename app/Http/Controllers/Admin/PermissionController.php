<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->paginate(5);
        return view('admin.permissions.index', compact('permissions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);
        Permission::create($request->all());
        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return View::make('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        request()->validate([
            'name' => 'required',
        ]);
        $permission->update(['name' => $request->name]);
        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully');
    }

    public function destroy(Permission $permission)
    {
        if ($permission->id) {
            $permission->delete();
            return redirect()->route('admin.permissions.index')
                ->with('success', 'Permission deleted successfully');
        }
        return redirect()->route('admin.permissions.index')
            ->with('error', 'Error in Permission deletion.');
    }
}
