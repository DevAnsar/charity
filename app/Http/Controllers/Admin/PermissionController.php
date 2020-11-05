<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.settings.permissions.index', compact('roles', 'permissions'));
    }

    public function givePermissionToRole(Request $request)
    {

        $input = $request->all();
        $role = Role::findOrfail($input['roleId']);
        $role->givePermissionTo($input['permission']);

        return response()->json(['status' => true]);
    }


    public function revokePermissionToRole(Request $request)
    {

//        return $request->route()->getName();
        $input = $request->all();
        $role = Role::findOrfail($input['roleId']);
        $role->revokePermissionTo($input['permission']);
        return response()->json(['status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Permission::create(['name' => $request->name, 'guard_name' => 'web']);
        return redirect(route('panel.permissions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        if (empty($permission)) {
//            Flash::error('Permission not found');
            return redirect(route('panel.permissions.index'));
        }
        return view('admin.settings.permissions.edit',compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $permission = Permission::find($id);

        if (empty($permission)) {
//            Flash::error('Permission not found');
            return redirect(route('panel.permissions.index'));
        }

        $permission = $permission->update($request->all());

//        Flash::success('Permission updated successfully.');

        return redirect(route('panel.permissions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (empty($permission)) {
//            Flash::error('Permission not found');

            return redirect(route('panel.permissions.index'));
        }
        $permission->delete($id);
//        Flash::success('Permission deleted successfully.');
        return redirect(route('panel.permissions.index'));
    }
}
