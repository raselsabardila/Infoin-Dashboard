<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Eo_Verification;

class Eo_VerificationController extends Controller
{
    public function verification(){
        if(Auth::user()->phone == null){
            return redirect()->back()->with("error","Isi terlebih dahulu field nomor telepon kalian");
        }
        if (Auth::user()->verifications()) {
            if (Auth::user()->verifications()->status == 0 || Auth::user()->verifications()->status == 1) {
                return redirect()->back()->with("error","Kamu sudah terdaftar");
            }
        }

        return view("user.verification-eo.verification");
    }

    public function store(Request $request){
        $request->validate([
            "ktp" => "required|mimes:png,jpg,jpeg,svg"
        ]);

        $recent = Eo_Verification::where("user_id",Auth::id())->where("status",2)->get();
        $allFiles = \Storage::allFiles("public/ktp");
    
        if (!empty($recent)) {
            foreach ($recent as $key => $value) {
                $recentKtp = \explode("/",$value->ktp);
                $recentKtp_name = $recentKtp[2];
                foreach ($allFiles as $key2 => $value2) {
                    $ktp_dir_explode = \explode("/",$value2);
                    if ($ktp_dir_explode[2] == $recentKtp_name) {
                        \Storage::disk("local")->delete($value2);
                    }
                }
                $value->delete();
            }
        }

        $file = $request->ktp;
        $name_file = $file->getClientOriginalName();

        $name_split = \explode(".",$name_file);
        $name_split[0] = \uniqid();

        $name_file_upload = "";
        $name_file_upload .= $name_split[0];
        $name_file_upload .= ".";
        $name_file_upload .= $name_split[1];

        \Storage::putFileAs("public/ktp",$file,$name_file_upload);
        
        Eo_Verification::create([
            "user_id" => Auth::id(),
            "ktp" => "storage/ktp/" . $name_file_upload,
        ]);

        return redirect()->route("profile.edit")->with("success","Berhasil mengirimkan verifikasi ke admin, tunggu respon dari admin");
    }

    public function show($id){
        $data = Eo_Verification::find($id);
        $data->update([
            "status_read" => 1
        ]);

        return view("admin.verifications.show",compact("data"));
    }

    public function index(){
        return view("admin.verifications.index");
    }

    public function readAll(){
        $data = Eo_Verification::where("status_read",0)->get();
        foreach ($data as $key => $value) {
            $value->update([
                "status_read" => 1
            ]);
        }
        return redirect()->back()->with("success","Notifikasi telah dibaca semua");
    }

    public function accept($id){
        $data = Eo_Verification::find($id);
        $data->update([
            "status" => 1
        ]);
        $data->user->update([
            "role_id" => 2
        ]);
        return redirect()->back()->with("success","Berhasil Menerima Permintaan Verifikasi");
    }

    public function decline($id){
        $data = Eo_Verification::find($id);
        $data->update([
            "status" => 2
        ]);
        return redirect()->back()->with("success","Berhasil Menolak Permintaan Verifikasi");
    }
}
