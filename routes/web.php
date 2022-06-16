<?php

use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GiangVienController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;  

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('checklogin');
Route::get('/student', [SinhVienController::class, 'getIndex'])->name('student.index')->middleware('checklogin');

// Route::get('/student/add', [SinhVienController::class, 'getAdd'])->name('student.add');
// Route::post('/student/add', [SinhVienController::class, 'postAdd']);
// Route::get('/student/edit/{id}', [SinhVienController::class, 'getEdit'])->name('student.edit');
// Route::post('/student/edit/{id}', [SinhVienController::class, 'postEdit']);
// Route::get('/student/del/{id}', [SinhVienController::class, 'getDel'])->name('student.del');
//auth-login
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'getLogout'])->name('logout');
Route::get('/register', [AuthController::class, 'getReg'])->name('register');
Route::post('/register', [AuthController::class, 'postReg']);
Route::get('/resetpassword', [AuthController::class, 'getReset'])->name('resetpassword');
Route::post('/resetpassword', [AuthController::class, 'postReset']);
Route::get('/resetpassword/reset/{token}', [AuthController::class, 'getResetForm'])->name('resetpasswordform');
route::post('/resetpassword/reset/{token}', [AuthController::class, 'postResetForm']);
// route::get('/mailreset', AuthController::class, 'getMail')->name('mail');
// // // giangvien
// Route::get('/teacher', [GiangVienController::class, 'getIndexGv'])->name('teacher.index')->middleware('auth');
// Route::get('/teacher/addgv', [GiangVienController::class, 'getAddGv'])->name('teacher.addgv');
// Route::post('/teacher/addgv', [GiangVienController::class, 'postAddGv']);
// Route::get('/teacher/editgv/{id}', [GiangVienController::class, 'getEditGv'])->name('teacher.editgv');
// Route::post('/teacher/editgv/{id}', [GiangVienController::class, 'updateGv']);
// Route::get('/teacher/del/{id}', [GiangVienController::class, 'getDel'])->name('teacher.del');
// //roles
// Route::get('/roles', [DashboardController::class, 'getIndex'])->name('roles.index')->middleware('auth');
// Route::get('/roles/add', [DashboardController::class, 'addRoles'])->name('roles.add');
// Route::post('/roles/add', [DashboardController::class, 'addUser']);
// Route::get('/roles/edit/{id}', [DashboardController::class, 'editRoles'])->name('roles.edit');
// Route::post('/roles/edit/{id}', [DashboardController::class, 'editUser']);
// Route::get('/roles/del/{id}', [DashboardController::class, 'delRoles'])->name('roles.del');
//user
// Route::get('/user', [UserController::class, 'getIndex'])->name('user.index')->middleware('auth');
// Route::get('/user/add', [UserController::class, 'getAddUser'])->name('user.add');
// Route::post('/user/add', [UserController::class, 'postAddUser']);
// Route::get('/user/edit/{id}', [UserController::class, 'getEditUser'])->name('user.edit');
// Route::post('/user/edit/{id}', [UserController::class, 'postEditUser']);
// Route::get('/user/del/{id}', [UserController::class, 'delUser'])->name('user.del');
//changelanguage
// Route::group(['middleware' => 'locale'], function() {
//     Route::get('/changelanguage/{language}', [HomeController::class, 'changeLanguage'])->name('changelanguage');
// });
Route::group([   'middleware' => 'locale'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/student', [SinhVienController::class, 'getIndex'])->name('student.index');
    Route::get('/student/add', [SinhVienController::class, 'getAdd'])->name('student.add');
    Route::post('/student/add', [SinhVienController::class, 'postAdd']);
    Route::get('/student/edit/{id}', [SinhVienController::class, 'getEdit'])->name('student.edit');
    Route::post('/student/edit/{id}', [SinhVienController::class, 'postEdit']);
    Route::get('/student/del/{id}', [SinhVienController::class, 'getDel'])->name('student.del');
    // giangvien
    Route::get('/teacher', [GiangVienController::class, 'getIndexGv'])->name('teacher.index')->middleware('checklogin');
    Route::get('/teacher/addgv', [GiangVienController::class, 'getAddGv'])->name('teacher.addgv');
    Route::post('/teacher/addgv', [GiangVienController::class, 'postAddGv']);
    Route::get('/teacher/editgv/{id}', [GiangVienController::class, 'getEditGv'])->name('teacher.editgv');
    Route::post('/teacher/editgv/{id}', [GiangVienController::class, 'updateGv']);
    Route::get('/teacher/del/{id}', [GiangVienController::class, 'getDel'])->name('teacher.del');
    //roles
    Route::get('/roles', [DashboardController::class, 'getIndex'])->name('roles.index')->middleware('auth')->middleware('checklogin');
    Route::get('/roles/add', [DashboardController::class, 'addRoles'])->name('roles.add');
    Route::post('/roles/add', [DashboardController::class, 'addUser']);
    Route::get('/roles/edit/{id}', [DashboardController::class, 'editRoles'])->name('roles.edit');
    Route::post('/roles/edit/{id}', [DashboardController::class, 'editUser']);
    Route::get('/roles/del/{id}', [DashboardController::class, 'delRoles'])->name('roles.del');
    //user
    Route::get('/user', [UserController::class, 'getIndex'])->name('user.index')->middleware('checklogin');
    Route::get('/user/add', [UserController::class, 'getAddUser'])->name('user.add');
    Route::post('/user/add', [UserController::class, 'postAddUser']);
    Route::get('/user/edit/{id}', [UserController::class, 'getEditUser'])->name('user.edit');
    Route::post('/user/edit/{id}', [UserController::class, 'postEditUser']);
    Route::get('/user/del/{id}', [UserController::class, 'delUser'])->name('user.del');
	Route::get('/changelanguage/{language}', [HomeController::class, 'changeLanguage'])->name('changelanguage');
});

Route::view('/{any}', 'user')
    ->where('any', '.*');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
