<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SSLController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 //Route::__get('first-api')->get('/firstApi', function (Request $request) {
 //    return $request->firstApi();
 //});

Route::get('test',[TestController::class,'test']);

Route::get('get-blogs/{id?}',[BlogController::class,'getBlogs']);

Route::post('add-blog',[BlogController::class,'addBlog']);

Route::put('update-blog',[BlogController::class,'updateBlog']);

Route::delete('delete-blog',[BlogController::class,'deleteBlog']);

Route::get('search-blog/{param}',[BlogController::class,'searchBlog']);


Route::post('login',[UserController::class,'login']);
Route::get('login',[UserController::class,'login']);
Route::post('registration',[UserController::class,'registration']);

Route::get('get-external-post',[PostController::class,'getExternalPost']);


Route::get('get-external-blog',[BlogController::class,'getExternalBLog']);

// SSL
Route::apiResource('ssl',SSLController::class);

Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
    Route::apiResource('admin', AdminController::class);
});

Route::group(['middleware'=>['auth:api','role:user']],function(){
    Route::apiResource('post',PostController::class);
    Route::get('get-private-post',[PostController::class,'getPrivatePosts']);

    Route::apiResource('brand',BrandController::class);
    Route::post('get-brands',[BrandController::class,'getBrands']);

    Route::apiResource('profile',ProfileController::class);
    Route::get('get-profile',[ProfileController::class,'getProfile']);
    Route::post('update-profile',[ProfileController::class,'updateProfile']);
});

