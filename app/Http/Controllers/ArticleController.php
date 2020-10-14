<?php

namespace App\Http\Controllers;

use App\Article;
use Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("articles.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|min:3",
            "thumbnail" => "required|mimes:png,jpg,jpeg,svg",
            "content" => "required|min:10",
            "categori_id" => "required",
            "status_id" => "required",
        ]);

        $file = $request->file("thumbnail");
        $name_file = $file->getClientOriginalName();
            
        $name_split = \explode(".",$name_file);
        $name_split[0] = \uniqid();

        $name_file_upload = "";
        $name_file_upload .= $name_split[0];
        $name_file_upload .= ".";
        $name_file_upload .= $name_split[1];

        \Storage::putFileAs("public/thumbnail",$file,$name_file_upload);

        Article::create([
            "title" => $request->title,
            "content" => $request->content,
            "categori_id" => $request->categori_id,
            "status_id" => $request->status_id,
            "user_id" => Auth::id(),
            "slug" => \Str::slug($request->title) . "-" . \Str::random(5),
            "thumbnail" => $name_file_upload
        ]);

        return redirect()->back()->with("successArticle","Berhasil membuat artikel baru");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($article)
    {
        $articleEdit = Article::withTrashed()->where("user_id",Auth::id())->where("slug",$article)->first();
        if ($articleEdit->user_id != Auth::id()) {
            return redirect()->back()->with("error","Kamu tidak memiliki hak akses");
        }
        return view("articles.index",compact("articleEdit"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $article)
    {
        $articleEdit = Article::withTrashed()->where("user_id",Auth::id())->where("slug",$article)->first();

        $request->validate([
            "title" => "required|min:3",
            "content" => "required|min:10",
            "categori_id" => "required",
            "status_id" => "required",
        ]);

        if ($request->thumbnail == null) {
            $articleEdit->update([
                "title" => $request->title,
                "content" => $request->content,
                "categori_id" => $request->categori_id,
                "status_id" => $request->status_id,
                "user_id" => Auth::id(),
                "slug" => \Str::slug($request->title) . "-" . \Str::random(5)
            ]);
        } else{
            $name = $this->thumbnail($request->file("thumbnail"),$articleEdit);
            $articleEdit->update([
                "title" => $request->title,
                "content" => $request->content,
                "categori_id" => $request->categori_id,
                "status_id" => $request->status_id,
                "user_id" => Auth::id(),
                "slug" => \Str::slug($request->title) . "-" . \Str::random(5),
                "thumbnail" => $name
            ]);
        }

        return redirect()->route("articles.index")->with("successArticle","Berhasil merubah artikel");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function image(Request $request){
        if ($request->hasFile('upload')) {
            $file = $request->file('upload'); //SIMPAN SEMENTARA FILENYA KE VARIABLE
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); //KITA GET ORIGINAL NAME-NYA
            //KEMUDIAN GENERATE NAMA YANG BARU KOMBINASI NAMA FILE + TIME
            $fileName = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();
    
            \Storage::putFileAs("public/images",$file,$fileName); //SIMPAN KE DALAM FOLDER PUBLIC/UPLOADS
    
            //KEMUDIAN KITA BUAT RESPONSE KE CKEDITOR
            $ckeditor = $request->input('CKEditorFuncNum');
            $url = asset("storage/images/$fileName"); 
            $msg = 'Image uploaded successfully'; 
            //DENGNA MENGIRIMKAN INFORMASI URL FILE DAN MESSAGE
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url', '$msg')</script>";
    
            //SET HEADERNYA
            @header('Content-type: text/html; charset=utf-8'); 
            return $response;
        }  
    }

    public function thumbnail($file, $article){
        $name_file = $file->getClientOriginalName();
        $format = ["png","jpg","svg","jpeg"];

        $name_split = \explode(".",$name_file);
        $name_split[0] = \uniqid();

        if(!\in_array($name_split[1],$format)){
            return redirect()->back()->with("errorArticle","Format gambar tidak sesuai");
        }

        $name_file_upload = "";
        $name_file_upload .= $name_split[0];
        $name_file_upload .= ".";
        $name_file_upload .= $name_split[1];

        if ($article->thumbnail != null) {
            $nameInFolder = $article->thumbnail;
            $folder = \Storage::allFiles("public/thumbnail");
            foreach ($folder as $key => $value) {
                $nameFileFolder = \explode("/",$value);
                if ($nameFileFolder[2] == $nameInFolder) {
                    \Storage::disk("local")->delete($value);
                }
            }
        }
        \Storage::putFileAs("public/thumbnail",$file,$name_file_upload);

        return $name_file_upload;
    }
}
