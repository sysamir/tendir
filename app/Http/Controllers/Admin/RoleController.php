<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Permission;
use App\Models\Role;
use Alert;
use Illuminate\Http\Request;

class RoleController extends Controller {

    protected $templateDIR = 'admin.panel.roles.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withCount('users')->get();

        return view($this->templateDIR . 'index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = [
            'route'  => ['roles.store'],
            'method' => 'post',
        ];

        $permissions = Permission::all();

        return view($this->templateDIR . 'form', compact('options', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|unique:roles',
            'display_name' => 'required|min:3',
            'permissions'  => 'required',
        ]);

        $role = new Role();
        $role->name = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');
        $role->save();

        $role->permissions()->sync($request->get('permissions'));

        Alert::success('New Role has been created!');

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
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
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $options = [
            'route'  => ['roles.update', $id],
            'method' => 'put',
        ];

        $item = Role::with('permissions')->find($id);
        $rolePermissions = $item->permissions->pluck('id')->all();


        $permissions = Permission::all();

        return view($this->templateDIR . 'form', compact('item', 'options', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'         => 'required|unique:roles,name,' . $id,
            'display_name' => 'required|min:3',
            'permissions'  => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');
        $role->save();

        $role->permissions()->sync($request->get('permissions'));

        Alert::success('The Role information has been updated!');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Role::find($id);
        if ( ! $item)
        {
            Alert::error("Role not found!");
        } else
        {
            Alert::warning("'" . $item->display_name . "' has been deleted!");
            $item->delete();
        }

        return redirect()->route('roles.index');
    }
}
