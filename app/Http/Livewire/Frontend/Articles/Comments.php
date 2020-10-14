<?php

namespace App\Http\Livewire\Frontend\Articles;

use Livewire\Component;
use Auth;
use App\Comment;

class Comments extends Component
{

    public $comment_input;
    public $article;
    public $parent;

    protected $listeners = [
        "setReply"
    ];

    public function mount($article){
        $this->article = $article;
    }

    public function render()
    {
        return view('livewire.frontend.articles.comments');
    }

    public function setComment(){
        Comment::create([
            "user_id" => Auth::id(),
            "article_id" => $this->article->id,
            "comment" => $this->comment_input,
            "parent" => 0
        ]);

        $this->comment_input = null;
        $this->emit("storeComment");
    }

    public function setReply($id){
        $comment = Comment::find($id);
        $this->parent = $comment->id;
        $this->comment_input = $comment->user->email;
    }

    public function storeReply(){
        Comment::create([
            "user_id" => Auth::id(),
            "article_id" => $this->article->id,
            "comment" => $this->comment_input,
            "parent" => $this->parent
        ]);

        $this->comment_input = null;
        $this->emit("storeReply");
    }
}
