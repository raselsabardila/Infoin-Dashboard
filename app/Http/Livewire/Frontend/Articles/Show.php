<?php

namespace App\Http\Livewire\Frontend\Articles;

use Livewire\Component;
use App\Article;
use App\View;
use Auth;
use App\Comment;

class Show extends Component
{
    public $article;
    protected $listeners = [
        "storeComment",
        "storeReply"
    ];

    public function mount($article){
        $this->article = $article;
    }

    public function render()
    {
        $this->viewDetech();

        $link = \URL::current();

        $comments = Comment::where("article_id", $this->article->id)->where("parent",0)->get();
        $articlesLatest = Article::where("status_id",1)->latest()->get()->take(3);
        return view('livewire.frontend.articles.show',compact("articlesLatest","link","comments"));
    }

    public function viewDetech(){
        $views = View::where("user_id",Auth::id())->get();
        $articles = [];
        if ($views->count() != null) {
            foreach ($views as $key => $value) {
                $articles[] = $value->article_id;
            }
        }

        if (!in_array($this->article->id, $articles)) {
            View::create([
                "user_id" => Auth::id(),
                "article_id" => $this->article->id
            ]);
        }
    }

    public function storeComment(){
        
    }

    public function storeReply(){
        
    }

    public function reply($id){
        $this->emit("setReply",$id);
    }

}
