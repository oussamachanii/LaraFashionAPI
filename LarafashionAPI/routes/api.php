<?php

// use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HomePageController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group( function ()
{   
    
    //Home page routes
    Route::get('trend/', [HomePageController::class,'trend']);
    Route::get('deals/', [HomePageController::class,'deals']);
    Route::get('rated/', [HomePageController::class,'rated']);
    //Auth
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    // Route::get('category/{id?}/{type}', [HomePageController::class,'show']);
    //Protected Auth Routes
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('getUserByToken', [AuthController::class,'getUserByToken']);
        Route::middleware('admin')->group(function ()
        {
        //     Route::get('user/', function () {
        //        return User::all();
        //    });
        });
    });
});