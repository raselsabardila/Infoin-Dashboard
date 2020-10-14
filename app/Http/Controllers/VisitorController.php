<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;

class VisitorController extends Controller
{
    public function index(){
        return view("admin.visitors.index");
    }
}
