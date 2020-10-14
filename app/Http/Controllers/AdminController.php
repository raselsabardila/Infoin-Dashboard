<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Eo_Verification;

class AdminController extends Controller
{
    public function dashboard(){
        $user = User::where("role_id",1)->get();
        $admin = User::where("role_id",3)->get();
        $eo = User::where("role_id",2)->get();
        return view("home",compact("user","admin","eo"));
    }

    public function adminList(){
        $role = 3;
        return view("admin.users.index",compact("role"));
    }

    public function userList(){
        $role = 1;
        return view("admin.users.index",compact("role"));
    }

    public function eoList(){
        $role = 2;
        return view("admin.users.index",compact("role"));
    }
}
