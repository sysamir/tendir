<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Admin;
use App\Models\Role;
use Alert;
use Auth;
use Illuminate\Http\Request;

class MainController extends Controller {

    public function home()
    {
        return view('front.home');
    }
}
