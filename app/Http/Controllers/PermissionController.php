<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('Admin.dist.creative.permission.index', [
            'title' => 'Trang Quản Lý Quyền'
        ], compact('permissions'));
    }

    public function create()
    {
        return view('Admin.dist.creative.permission.add', [
            'title' => 'Trang Quản Lý Quyền'
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::create($request->all());
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        return redirect()->route('permission.index');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('Admin.dist.creative.permission.edit', [
            'title' => 'Trang Quản Lý Quyền'
        ], compact('permission'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::find($id)->update($request->all());
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        return redirect()->route('permission.index');
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::find($id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        return redirect()->route('permission.index');
    }
}
