<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students',[StudentController::class,'index']);  //Untuk membuat route Api
Route::post('students',[StudentController::class,'store']);  //Untuk membuat route Api yang mempost data untuk data base
Route::get('students/{id}',[StudentController::class,'show']);  //Untuk membuat route Api yang mengshow data untuk data base yang diinginkan
Route::get('students/{id}/edit',[StudentController::class,'edit']);  //Untuk membuat route Api yang mengedit data untuk data base yang diinginkan
Route::put('students/{id}/edit',[StudentController::class,'update']);  //Untuk membuat route Api yang mengupdate data untuk data base yang diinginkan
Route::delete('students/{id}/destroy',[StudentController::class,'destroy']);  //Untuk membuat route Api yang menghapus data untuk data base yang diinginkan



