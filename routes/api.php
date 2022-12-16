<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::get('/user/', function () {

    $data = User::all();
    if($data)
        return response()->json($data,200);
    return response()->json(['msg' =>"user not found"], 200);
});


Route::post('login',[AuthController::class,'login'])->name('api.login');
Route::post('register',[AuthController::class,'register'])->name('api.register');
Route::group(['middleware'=>'auth:api','prefix'=>'api'],function(){

});
