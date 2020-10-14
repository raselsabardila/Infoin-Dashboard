<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('google', 'GoogleController@redirect');
Route::get('google/callback', 'GoogleController@callback');

Route::get('/', "LandingPageController@index")->name("landingPage");

Route::get("/tulisan-masyarakat","ArticleFeController@index")->name("tm.index");
Route::get("/tulisan-masyarakat/{article}","ArticleFeController@show")->name("tm.show");

Route::group(['middleware' => ['auth','checkRole']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get("/dashboard-admin","AdminController@dashboard")->name("admin.dashboard");

    Route::get("/visitors","VisitorController@index")->name("visitors.index");

    Route::get("/admin-list","AdminController@adminList")->name("users.adminList");
    Route::get("/user-list","AdminController@userList")->name("users.userList");
    Route::get("/eo-list","AdminController@eoList")->name("users.eoList");

    Route::get("/verifications/{id}/show","Eo_VerificationController@show")->name("eo.showVerification");
    Route::get("/verifications/show-all","Eo_VerificationController@index")->name("eo.indexVerification");
    route::get("/verifications/read-all","Eo_VerificationController@readAll")->name("eo.readAllVerification");
    Route::get("/verifications/{id}/accept","Eo_VerificationController@accept")->name("eo.acceptVerification");
    Route::get("/verifications/{id}/decline","Eo_VerificationController@decline")->name("eo.declineVerification");

    Route::get("/categories","CategoriController@index")->name("categories.index");

    Route::get("/status","StatusController@index")->name("status.index");
});

Route::group(['middleware' => ['auth','user']], function () {
    Route::get("/dashboard-user","UserController@dashboard")->name("user.dashboard");

    Route::get("/eo-verification","Eo_VerificationController@verification")->name("eo.verification");
    Route::post("/eo-verification","Eo_VerificationController@store")->name("eo.storeVerification");
});

Route::group(['middleware' => ['auth','eo']], function () {
    Route::get("/dashboard-eo","EoController@dashboard")->name("eo.dashboard");
});

Route::group(['middleware' => ['auth']], function () {
    Route::get("/profile/edit","ProfileController@edit")->name("profile.edit");
    Route::resource("/articles","ArticleController");

    Route::post("/image-upload","ArticleController@image")->name("articles.image");

    Route::resource("/contact-admin","ChatController");
});