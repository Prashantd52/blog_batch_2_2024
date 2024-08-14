<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/get_connection',[AuthController::class,'get_connection']);
Route::post('/login',[AuthController::class,'login']);

Route::get('blog_list',[BlogController::class,'blog_list']);
// Route::get('blog_list','Api\BlogController@blog_list');

Route::post('upload_image',[BlogController::class,'upload_image']);