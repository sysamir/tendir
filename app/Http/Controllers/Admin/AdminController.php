<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Admin;
use App\Models\Role;
use Alert;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller {

    protected $templateDIR = 'admin.panel.admins.';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();

        return view($this->templateDIR . 'index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = [
            'route'  => ['admins.store'],
            'method' => 'post',
        ];

        $roles = Role::pluck('display_name', 'id')->all();

        return view($this->templateDIR . 'form', compact('options', 'roles'));
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
            'name'     => 'required',
            'email'    => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        $admin = new Admin();
        $admin->role_id = $request->get('role_id');
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->password = $request->get('password');
        $admin->save();

        $admin->attachRole($request->get('role_id'));

        Alert::success('New admin has been created!');

        return redirect()->route('admins.index');
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
            'route'  => ['admins.update', $id],
            'method' => 'put',
        ];
        $item = Admin::find($id);
        $roles = Role::pluck('display_name', 'id')->all();

        return view($this->templateDIR . 'form', compact('item', 'options', 'roles'));
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
            'name'     => 'required',
            'email'    => 'required|email|unique:admins,email,' . $id,
            'password' => 'min:6',
        ]);

        $admin = Admin::find($id);
        $admin->role_id = $request->get('role_id');
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        if ($request->get('password'))
            $admin->password = $request->get('password');
        $admin->save();

        $admin->roles()->sync([$request->get('role_id')]);

        Alert::success('The admin information has been updated!');

        return redirect()->route('admins.index');
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
        $item = Admin::find($id);
        if ( ! $item)
        {
            Alert::error("Admin not found!");
        } else
        {
            Alert::warning("'" . $item->name . "' has been deleted!");
            $item->delete();
        }

        return redirect()->route('admins.index');
    }
}
