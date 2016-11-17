<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Company;
use Alert;
use Illuminate\Http\Request;

class CompanyController extends Controller {

    protected $templateDIR = 'admin.panel.companies.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'DESC')->paginate(30);

        return view($this->templateDIR . 'index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = [
            'route'  => ['companies.store'],
            'method' => 'post',
        ];

        return view($this->templateDIR . 'form', compact('options'));
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
            'name'       => 'required',
            'username'   => 'required|unique:companies',
            'password'   => 'required|min:6',
        ]);

        $company = new Company();
        $company->name = $request->get('name');
        $company->username = $request->get('username');
        $company->password = $request->get('password');
        $company->info = $request->get('info');
        $company->phone = $request->get('phone');
        $company->save();

        Alert::success('New Company has been created!');

        return redirect()->route('companies.index');
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
            'route'  => ['companies.update', $id],
            'method' => 'put',
        ];

        $item = Company::find($id);
        $categories = Category::plucky();

        return view($this->templateDIR . 'form', compact('item', 'options', 'categories'));
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
            'name'       => 'required',
            'username'   => 'required|unique:companies,username,' . $id,
            'password'   => 'min:6',
        ]);

        $company = Company::find($id);
        $company->name = $request->get('name');
        $company->username = $request->get('username');

        if ($request->has('password'))
            $company->password = $request->get('password');

        $company->info = $request->get('info');
        $company->voen = $request->get('voen');
        $company->phone = $request->get('phone');
        $company->email = $request->get('email');
        $company->user_full_name = $request->get('user_full_name');
        $company->user_email = $request->get('user_email');
        $company->user_phone = $request->get('user_phone');
        $company->user_profession = $request->get('user_profession');
        $company->save();

        Alert::success('The Company information has been updated!');

        return redirect()->route('companies.index');
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
        $item = Company::find($id);
        if ( ! $item)
        {
            Alert::error("Company not found!");
        } else
        {
            Alert::warning("'" . $item->name . "' has been deleted!");
            $item->delete();
        }

        return redirect()->route('companies.index');
    }
}
