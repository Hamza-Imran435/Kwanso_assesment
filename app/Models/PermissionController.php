<?php

namespace App\Models;

use App\Services\PermissionService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PermissionController extends Model
{
    public function __construct(protected PermissionService $service) {}

    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view('Auth/role_permission/index', compact('roles'));
    }

    public function detail($id)
    {
        $decodedId = base64_decode($id);

        $role = Role::with('permissions')->where('id', $decodedId)->first();

        $permissions = Permission::orderBy('id', 'asc')->get();

        return view('Auth/role_permission/detail', compact('role', 'permissions'));
    }

    public function updatePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->back()->with('success', 'Permissions updated successfully!');
    }
}
