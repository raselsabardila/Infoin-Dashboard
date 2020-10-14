<?php

namespace App\Http\Livewire\Visitors;

use Livewire\Component;
use App\Visitor;
use Livewire\WithPagination;
use App\User;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $visitors = Visitor::latest()->paginate(10);
        return view('livewire.visitors.index',compact("visitors"));
    }

    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }
}
