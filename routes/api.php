<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\authenticationController;
use App\Http\Controllers\StudentsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students',[StudentsController::class,'index']);

Route::post('students/postStudent',[StudentsController::class,'create']);

Route::get('students/getById/{id}',[StudentsController::class,'getById']);

Route::post('authentication',[authenticationController::class,'authentication']);

Route::get('anggota/getAll',[AnggotaController::class,'index']);

Route::get('anggota/getById/{id}',[AnggotaController::class,'getById']);

Route::post('anggota/Insert',[AnggotaController::class,'addAnggota']);

Route::put('anggota/Edit/{id}',[AnggotaController::class,'EditAnggota']);

Route::delete('anggota/Delete/{id}',[AnggotaController::class,'DeleteAnggota']);