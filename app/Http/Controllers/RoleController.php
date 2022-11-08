<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('Admin.dist.creative.role.index', [
            'title' => 'Trang Quản Lý Nhân Viên'
        ], compact('roles'));
    }

    public function create()
    {
        return view('Admin.dist.creative.role.add', [
            'title' => 'Trang Quản Lý Vai Trò'
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name]);
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }
        session()->put('success', 'Role Successfully Created.');
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view('Admin.dist.creative.role.edit', [
            'title' => 'Trang Quản Lý Vai Trò'
        ], compact('role'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $role = Role::find($id)->update($request->all());
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        return redirect()->route('role.index');
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $role = Role::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }
        session()->put('success', 'Role Successfully Deleted.');

        return redirect()->route('role.index');
    }

    public function viewAssignPermision($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('Admin.dist.creative.role.assign_permission', compact('role', 'permissions'))->render();
    }

    public function assignPermissions(Request $request, $id)
    {
        $role = Role::find($id);
        $role->syncPermissions($request->permission);

        return back();
    }

    public function viewAssignUser($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('Admin.dist.creative.staff.assign_role', compact('user', 'roles'))->render();
    }

    public function assignUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->assignRole($request->role);

        return back();
    }
}
