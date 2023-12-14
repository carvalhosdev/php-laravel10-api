<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\EnglishController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\BlockOtherAccountAction;
use App\Http\Middleware\BlockOwnerAction;
use App\Http\Middleware\BlockUserToAdmin;
use App\Http\Middleware\EnsureAdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("/login", [AuthController::class, 'login']);
Route::post("/register",[UserController::class, 'registerUser']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post("/logout", [AuthController::class, 'logout']);
    
    Route::prefix('user')->group(function(){
        Route::get("me", [AuthController::class,  'me']);
        Route::get("/all", [UserController::class, 'getAllUsers'])->middleware([EnsureAdminUser::class]);
        Route::get("/child", [UserController::class, 'userChildList'])->middleware([EnsureAdminUser::class]);
        Route::post("/add-new", [UserController::class, 'addUserByAdmin'])->middleware([EnsureAdminUser::class]);
        Route::get("{id}", [UserController::class, 'getUserById'])->middleware([BlockOtherAccountAction::class]);
        Route::put("{id}", [UserController::class, 'updateUser'])->middleware([BlockOtherAccountAction::class, BlockUserToAdmin::class]);
        Route::delete("remove", [UserController::class, 'destroyUser'])->middleware([EnsureAdminUser::class, BlockOwnerAction::class]);
       
    });
    

    

    Route::prefix('english')->group(function(){
      
        Route::get("/card", [CardController::class, 'all']);
        Route::post("/card", [CardController::class, 'store']);
        Route::get("/card/{id}", [CardController::class, 'byId']);
        Route::put("/card/{id}", [CardController::class, 'update']);
        Route::delete("/card/{id}", [CardController::class, 'destroy']);


        Route::get("/phrase", [EnglishController::class, 'all']);
        Route::post("/phrase", [EnglishController::class, 'store']);
        Route::get("/phrase/{id}", [EnglishController::class, 'byId']);
        Route::put("/phrase/{id}", [EnglishController::class, 'update']);
        
        Route::delete("/phrase/{id}", [EnglishController::class, 'destroy']);

        
    });
});
