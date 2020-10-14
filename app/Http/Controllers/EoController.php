<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class EoController extends Controller
{
    public function dashboard(){
        return view("home");
    }
}
