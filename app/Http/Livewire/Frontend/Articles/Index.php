<?php

namespace App\Http\Livewire\Frontend\Articles;

use Livewire\Component;
use App\Article;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $articlesLatest = Article::where("status_id",1)->latest()->get()->take(3);
        $articlesOldest;

        if ($this->search != null) {
            $articlesOldest = Article::where("title",$this->search)->orWhere("title","like","%".$this->search."%")->where("status_id",1)->orderBy("created_at","ASC")->paginate(6);
        } else {
            $articlesOldest = Article::where("status_id",1)->orderBy("created_at","ASC")->paginate(6);
        }
        
        return view('livewire.frontend.articles.index',compact("articlesLatest","articlesOldest"));
    }
}
