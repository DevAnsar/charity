<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.settings.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Role::create(['name' => $request->name, 'guard_name' => 'web']);
        return redirect(route('panel.roles.index'));
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
        $role = Role::find($id);

        if (empty($role)) {
//            Flash::error('Permission not found');
            return redirect(route('panel.roles.index'));
        }
        return view('admin.settings.roles.edit')->with('role', $role);
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

        $role = Role::find($id);

        if (empty($role)) {
//            Flash::error('Permission not found');
            return redirect(route('panel.roles.index'));
        }

        $role->update(array_merge($request->all(), ['guard' => 'web']));

//        Flash::success('Permission updated successfully.');

        return redirect(route('panel.roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if (empty($role)) {
//            Flash::error('Permission not found');

            return redirect(route('panel.roles.index'));
        }
        $role->delete($id);
//        Flash::success('Permission deleted successfully.');
        return redirect(route('panel.roles.index'));
    }
}
