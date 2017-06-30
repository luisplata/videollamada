<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RootController extends Controller {

    //
    public function dashboard() {
        dd(Session::get("root"));
    }

}
