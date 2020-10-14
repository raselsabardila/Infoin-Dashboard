<?php

namespace App\Http\Livewire\Admin\Status;

use Livewire\Component;
use App\Status;

class Create extends Component
{
    public $name;    

    public function render()
    {
        return view('livewire.admin.status.create');
    }

    public function store(){
        $this->validate([
            "name" => "required|min:3"
        ]);

        $status = Status::create([
            "name" => $this->name,
            "slug" => \Str::slug($this->name) . "-" . \Str::random(5)
        ]);

        $name = $status->name;
        $this->resetInput();
        $this->emit("storeStatus",$name);
    }

    public function resetInput(){
        $this->name = null;
    }
}
