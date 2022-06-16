<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function getIndex(){
        $listuser = DB::table('users as u')->join('roles as r', 'r.id', '=', 'u.role_id')->select('u.id','u.name', 'u.email', 'r.name as nameRole')->get();
        // dd($user);
        return view('admin.user.index', ['list' => $listuser]);
    }
    public function getAddUser(){
        $roles = DB::table('roles as r')->select('r.id', 'r.name')->get();
        // dd($roles);
        return view('admin.user.add', ['roles' => $roles]);
    }
    public function postAddUser(Request $Request){
        $validateRoles = [
            // 'user_id' => 'required',
            'name' => 'required',
            'email'=> 'required|email',
            'password'=>'required',

        ];
        $validateRolesCheck = [
            // 'user_id.required' => 'User ID không được bỏ trống',
            'name.required' => 'Họ và tên không được bỏ trống',
            'email.required'=>'Email không được bỏ trống',
            'email.email'=>'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được bỏ trống',

        ];
        $validator= validator::make($Request->all(), $validateRoles, $validateRolesCheck);
        if($validator->fails()){
            return redirect()->route('roles.add')->withErrors($validator)->withInput();
        }
        DB::table('users')->insert([
            'name'=>$Request->input('name'),
            'email'=>$Request->input('email'),
            'password'=>Hash::Make($Request->password),
            'role_id'=> $Request->input('roles'),
        ]);
        return redirect()->route('user.index')->with('alert_success', 'Thêm user thành công');
    }
    public function getEditUser($id){
        $roles = DB::table('roles as r')->select('r.id', 'r.name')->get();
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.user.edit', ['user'=>$user, 'roles' => $roles]);
    }
    public function postEditUser(Request $request, $id){
        $validateUser = [
            'name' => 'required',
            'email'=>'required|email',
        ];
        $validateUserCheck = [
            'name.required'=> 'Họ Và Tên không được để trống',
            'email.email'=>'Email không đúng định dạng',
            'email.required'=>'Email không được để trống'
        ];
        $validator = validator::make($request->all(), $validateUser, $validateUserCheck);
        if($validator->fails()){
            return redirect()->route('user.edit')->withErrors($validator)->withInput();
        }
             DB::table('users')->where('id', $id)->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'role_id'=>$request->input('roles'),
        ]);
        return redirect()->route('user.index')->with('alert_success', 'Sửa user thành công');
    }
    public function delUser($id){
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('user.index')->with('alert_success', 'Xóa user thành công');
    }
    public function apiIndex(){
        $user = DB::table('users as u')->join('roles as r', 'r.id', '=', 'u.role_id')->select('u.id','u.name', 'u.email', 'r.name as nameRole')->get();
        return response()->json([
            'data' => $user
        ]);
    }
}
