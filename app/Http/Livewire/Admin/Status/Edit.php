<?php

namespace App\Http\Livewire\Admin\Status;

use Livewire\Component;
use App\Status;

class Edit extends Component
{
    protected $listeners = [
        "editStatus"
    ];

    public $name;
    public $statusId;

    public function render()
    {
        return view('livewire.admin.status.edit');
    }

    public function editStatus($status){
        $this->name = $status["name"];
        $this->statusId = $status["id"];
    }

    public function updateStatus(){
        $status = Status::find($this->statusId);
        
        if ($status) {
            $status->update([
                "name" => $this->name,
                "slug" => \Str::slug($this->name) . "-" . \Str::random(5)
            ]);

            $name = $this->name;
            $this->resetInput();
            $this->emit("storeUpdate",$name);
        } else{
            $this->resetInput();
            $this->emit("errorUpdate");
        }
    }

    public function resetInput(){
        $this->name = null;
        $this->statusId = null;
    }
}
