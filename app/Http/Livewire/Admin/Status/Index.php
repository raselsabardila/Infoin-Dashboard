<?php

namespace App\Http\Livewire\Admin\Status;

use Livewire\Component;
use Livewire\WithPagination;
use App\Status;

class Index extends Component
{
    use WithPagination;
    
    public $statusUpdate = false;
    protected $listeners = [
        "storeStatus",
        "storeUpdate",
        "errorUpdate"
    ];
    
    public function render()
    {
        $status = Status::orderBy("name","ASC")->paginate(10);
        return view('livewire.admin.status.index',compact("status"));
    }

    public function storeStatus($name){
        \session()->flash("success","Berhasil Menambahkan " .$name. " status");
    }

    public function edit($id){
        $status = Status::find($id);
        $this->statusUpdate = true;
        $this->emit("editStatus",$status);
    }

    public function storeUpdate($name){
        \session()->flash("success","Berhasil mengubah " .$name. " status");
        $this->statusUpdate = false;
    }

    public function errorUpdate(){
        \session()->flash("error","Gagal mengubah status");
        $this->statusUpdate = false;
    }

    public function delete($id){
        $status = Status::find($id);
        $name = $status->name;
        $status->delete();
        \session()->flash("success","Berhasil menghapus " .$name. " kategori");
    }
}
