<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/hello", function(){
    return 'Hello World';
});

Route::get("/user/{username}", function(string $username){
    return "Oh, hello {$username}";
});

//with dependeces
Route::get("/user/{id}/posts/{post_id}", function(Request $request, $id, $post_id){
    return "The Post of " . $id . " is " . $post_id;
});

//optional parameters
Route::get("/useropt/{name?}", function(?string $name='blabla'){
    return $name;
});

//route named
Route::get("/user/profile", function(){
    return 'profile';
})->name("profile");

Route::get("/blade", function(){
    return view('blade_example');
});


//profix
Route::prefix('admin')->group(function(){
    Route::get("/users", function(){
        return "USER TAL";
    });

    Route::get("/user", [UserController::class, 'show'])->middleware('user');
    Route::get("/view/{name}", [UserController::class, 'viewBlade'])->middleware('user');
});

