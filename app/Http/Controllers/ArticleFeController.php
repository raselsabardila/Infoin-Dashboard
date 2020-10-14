<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleFeController extends Controller
{
    public function index(){
        return view("frontend.articles.article");
    }

    public function show(Article $article){
        return view("frontend.articles.show",compact("article"));
    }
}
