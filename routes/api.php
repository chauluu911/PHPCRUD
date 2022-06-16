<?php

use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\UserController;
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
Route::get('/user', [UserController::class, 'apiIndex'])->name('user.index');
Route::get('/student', [SinhVienController::class, 'apiIndex'])->name('student.index');
Route::post('/student/add', [SinhVienController::class, 'postAdd']);
Route::put('/student/edit', [SinhVienController::class, 'apiEdit']);
Route::delete('/student/del', [SinhVienController::class, 'apiDel']);
Route::get('/teacher', [GiangVienController::class, 'apiIndex'])->name('teacher.index');
