<?php

// use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\HomePageController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\PurchaseController;
use App\Http\Controllers\Api\V1\SearchController;
use App\Http\Controllers\Api\V1\SizeController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\ImageController;
use App\Models\Category;
use App\Models\Product;

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
    route::apiResource('product',ProductController::class)->only(['show']);
    
    route::apiResource('category',CategoryController::class)->only(['index','show']);
    route::apiResource('size',SizeController::class)->only(['index','show']);
    route::get('bag',[ProductController::class,'bag']);
    route::get('search/',[ProductController::class,'search']);
    //Protected Auth Routes
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('getUserByToken', [AuthController::class,'getUserByToken']);
        Route::put('user/password', [AuthController::class,'changePassword']);
        Route::apiResource('purchase',PurchaseController::class)->only('store');
        route::apiResource('user',UserController::class)->only('show');
        Route::middleware('admin')->group(function ()
        {
            route::apiResource('product',ProductController::class)->except(['show']);
            route::apiResource('purchase',PurchaseController::class)->except('store');
            route::apiResource('user',UserController::class)->except('show');
            route::apiResource('category',CategoryController::class)->except(['index','show']);
            route::apiResource('size',SizeController::class)->except(['index','show']);
        });
    });
});