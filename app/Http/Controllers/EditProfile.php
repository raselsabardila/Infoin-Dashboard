<?php

namespace App\Http\Controllers;

use \App\User;
use Auth;

class EditProfile extends Controller{
    
    public function storeDataUpdate($data,$user){
        $slug_split = \explode("-",$user->slug);
        $slug = \Str::slug($data["name"]) . "-" .$slug_split[\sizeOf($slug_split)-1];   
        
        if($data["avatar"] == null && $data["password"] == null){
            $user->update([
                "name" => $data["name"],
                "slug" => $slug,
                "phone" => $data["phone"]
            ]);

            return true;
        } else if($data["avatar"] == null){
            $user->update([
                "name" => $data["name"],
                "slug" => $slug,
                "password" => \bcrypt($data["password"]),
                "phone" => $data["phone"]
            ]);

            return true;
        } else if($data["password"] == null){

            $file = $data["avatar"];
            $name_file = $file->getClientOriginalName();
            $format = ["png","jpg","svg","jpeg"];

            $name_split = \explode(".",$name_file);
            $name_split[0] = \uniqid();

            if(!\in_array($name_split[1],$format)){
                return false;
            }

            $name_file_upload = "";
            $name_file_upload .= $name_split[0];
            $name_file_upload .= ".";
            $name_file_upload .= $name_split[1];

            if ($user->avatar != null) {
                $this->deleteImage($user);
            }
            \Storage::putFileAs("public/avatar",$file,$name_file_upload);

            $user->update([
                "name" => $data["name"],
                "slug" => $slug,
                "avatar" => "storage/avatar/" . $name_file_upload,
                "phone" => $data["phone"]
            ]);

            return true;
        } else{
            $file = $data["avatar"];
            $name_file = $file->getClientOriginalName();
            $format = ["png","jpg","svg","jpeg"];

            $name_split = \explode(".",$name_file);
            $name_split[0] = \uniqid();

            if(!\in_array($name_split[1],$format)){
                return false;
            }

            $name_file_upload = "";
            $name_file_upload .= $name_split[0];
            $name_file_upload .= ".";
            $name_file_upload .= $name_split[1];

            if ($user->avatar != null) {
                $this->deleteImage($user);
            }
            \Storage::putFileAs("public/avatar",$file,$name_file_upload);

            $user->update([
                "name" => $data["name"],
                "slug" => \Str::slug($data["name"]) . "-" . \Str::random(5),
                "avatar" => "storage/avatar/" . $name_file_upload,
                "password" => \bcrypt($data["password"]),
                "phone" => $data["phone"]
            ]);

            return true;
        }
    }

    public function deleteImage($user){
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

}