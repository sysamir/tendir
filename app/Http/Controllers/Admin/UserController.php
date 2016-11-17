<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Service;
use App\Models\Used;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller {

    /**
     * Template directory
     *
     * @var string
     */
    protected $templateDIR = 'admin.panel.users.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate();

        return view($this->templateDIR . 'index', compact('users'));
    }

    /**
     * Search users
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = trim($request->get('search'));
        $search = '%' . $query . '%';

        $users = User::where('name', 'like', $search)
            ->orWhere('surname', 'like', $search)
            ->orWhere('email', 'like', $search)
            ->orWhere('phone', 'like', $search)
            ->orderBy('id', 'DESC')
            ->paginate();

        return view($this->templateDIR . 'search', compact('users', 'query'));
    }

    /**
     * Services of user
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function appeals($id)
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = [
            'route'  => ['users.store'],
            'method' => 'post',
        ];

        return view($this->templateDIR . 'form', compact('options', 'brands'));
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
            'name'        => 'required',
            'surname'     => 'required',
            'phone'       => 'required',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:6',
            'avatar'      => 'image',
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->address = $request->get('address') ? : null;
        $user->birthday = $request->get('birthday') ? : null;
        $user->passport = $request->get('passport') ? : null;
        $user->professional = $request->get('professional') ? : null;
        $user->type = $request->has('type') ? $request->get('type') : null;
        $user->gender = $request->has('gender') ? $request->get('gender') : null;

        if ($request->get('password'))
            $user->password = $request->get('password');

        if ($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/user/avatar'), $fileName);
            $user->avatar = $fileName;
        }

        $user->save();

        Alert::success('New User has been created!');

        return redirect()->route('users.index');
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
            'route'  => ['users.update', $id],
            'method' => 'put',
        ];

        $item = User::find($id);

        return view($this->templateDIR . 'form', compact('item', 'options'));
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
            'name'        => 'required',
            'surname'     => 'required',
            'phone'       => 'required',
            'email'       => 'required|email|unique:users,email,' . $id,
            'password'    => 'min:6',
            'avatar'      => 'image',
        ]);


        $user = User::find($id);
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->address = $request->get('address') ? : null;
        $user->birthday = $request->get('birthday') ? : null;
        $user->passport = $request->get('passport') ? : null;
        $user->professional = $request->get('professional') ? : null;
        $user->gender = $request->has('gender') ? $request->get('gender') : null;

        if ($request->get('password'))
            $user->password = $request->get('password');

        if ($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/user/avatar'), $fileName);
            $user->avatar = $fileName;
        }

        $user->save();

        Alert::success($user->full_name . "'s information has been updated!");

        return redirect()->route('users.index');
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
        $item = User::find($id);
        if ( ! $item)
        {
            Alert::error("User not found!");
        } else
        {
            Alert::warning("'" . $item->full_name . "' has been deleted!");
            $item->delete();
        }

        return redirect()->route('users.index');
    }
}
