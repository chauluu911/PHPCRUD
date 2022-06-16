<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class DashboardController extends Controller
{
    //

    public function index() {
        return view('admin.dashboard');
    }
    public function getIndex(){
        $listuser = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        // return view('admin.roles.index', ['list' => $roles], ['listuser' =>$listuser], ['user'=>$user]);
        return view('admin.roles.index', ['list' => $roles, 'listuser' => $listuser]);
    }
    public function addRoles(){
        return view('admin.roles.add');
    }
    public function addUser(Request $Request){
        $validateRoles = [
            'name' => 'required',
        ];
        $validateRolesCheck = [
            'name.required' => 'Họ và tên không được bỏ trống',
        ];
        $validator= validator::make($Request->all(), $validateRoles, $validateRolesCheck);
        if($validator->fails()){
            return redirect()->route('roles.add')->withErrors($validator)->withInput();
        }
        DB::table('roles')->insert([
            'name'=>$Request->input('name'),
        ]);
        return redirect()->route('roles.index')->with('alert_success', 'Thêm quyền thành công');
    }
    public function editRoles($id){
        $roles = DB::table('roles')->where('id', $id)->first();
        return view('admin.roles.edit', ['roles'=>$roles]);
    }
    public function editUser(Request $request, $id ){
        $validateRoles = [
            // 'user_id' => 'required',
            'name' => 'required',
        ];
        $validateRolesCheck = [
            // 'user_id.required' => 'User ID không được bỏ trống',
            'name.required' => 'Quyền không được bỏ trống',
        ];
        $validator= validator::make($request->all(), $validateRoles, $validateRolesCheck);
        if($validator->fails()){
            return redirect()->route('roles.edit')->withErrors($validator)->withInput();
        }
        DB::table('roles')->where('id', $id)->update([
            'name'=>$request->input('name'),
        ]);
        return redirect()->route('roles.index')->with('alert_success', 'Sửa quyền thành công');
    }
    public function delRoles($id){
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles.index')->with('alert_success', 'Xóa quyền thành công');
    }
}
