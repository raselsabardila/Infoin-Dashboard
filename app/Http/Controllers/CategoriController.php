<?php

namespace App\Http\Controllers;

use App\Categori;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    public function index()
    {
        return view("admin.categori.index");
    }
}
