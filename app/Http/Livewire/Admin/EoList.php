<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;
use App\Eo_Verification;

class EoList extends Component
{
    use withPagination;
    public $search;
    public $idUser;
    public $statusDelete = false;
    public $paginate = 10;

    public function render()
    {
        $users;
        if ($this->search == null) {
            $users = User::orderBy("name","ASC")->where("role_id",2)->latest()->paginate($this->paginate);
        } else{
            $users = User::where("name",$this->search)->orWhere("name","like","%".$this->search."%")->where("role_id",2)->latest()->paginate($this->paginate);

        }
        return view('livewire.admin.eo-list',compact("users"));
    }

    public function delete($id){
        $this->idUser = $id;
        $this->statusDelete = true;
    }

    public function cancel(){
        $this->statusDelete = false;
        \session()->flash("error","Tidak Melanjutkan Penghapusan");
    }

    public function destroy(){
        $user = User::find($this->idUser);

        $filesktpall = \Storage::allFiles("public/ktp");
        foreach($user->eo_verifications as $item){
            $item_split = \explode("/",$item->ktp);
            foreach ($filesktpall as $key => $value) {
                $value_split = \explode("/",$value);
                if ($item_split[2] == $value_split[2]) {
                    \Storage::disk("local")->delete($value);
                }
            }
            $item->delete();
        }

        if ($user->avatar != null) {
            $files = \explode("/",$user->avatar);
            $file_name = $files[2];
            $allFiles = \Storage::allFiles("public/avatar");

            if($user->google_id != null){
                if($files[0] == "storage"){
                    foreach ($allFiles as $key => $value) {
                        $value_split = \explode("/",$value);
                        if ($value_split[2] == $file_name) {
                            \Storage::disk("local")->delete($value);
                        }
                    }
                }
            } else{
                foreach ($allFiles as $key => $value) {
                    $value_split = \explode("/",$value);
                    if ($value_split[2] == $file_name) {
                        \Storage::disk("local")->delete($value);
                    }
                }
            }
        }

        foreach ($user->recentLogin as $key => $value) {
            $value->delete();
        }
        $user->delete();
        $this->statusDelete = false;
        \session()->flash("success","Berhasil Melakukan Penghapusan");
    }
}
