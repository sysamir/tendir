<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Admin;
use App\Models\Role;
use Alert;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    protected $templateDir = 'admin.panel.dashboards.';
    public function main()
    {
        $role = Auth::guard('admin')->user()->role->name;

        return $this->{$role}();
    }

    public function super_admin()
    {
        return view($this->templateDir .  Auth::guard('admin')->user()->role->name);
    }

    public function company()
    {
        return view($this->templateDir .  Auth::guard('admin')->user()->role->name);
    }

    public function partner()
    {
        return view($this->templateDir .  Auth::guard('admin')->user()->role->name);
    }

    public function call_center()
    {
        return view($this->templateDir .  Auth::guard('admin')->user()->role->name);
    }

    public function admin()
    {
        return view($this->templateDir .  Auth::guard('admin')->user()->role->name);
    }

    public function moderator()
    {
        return view($this->templateDir .  Auth::guard('admin')->user()->role->name);
    }
}
