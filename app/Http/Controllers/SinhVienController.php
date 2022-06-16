<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class SinhVienController extends Controller
{
    public function getIndex(){ 
        $student = DB::table('sinhvien')->get();
        return view('admin.student.index', ['list' => $student]);
    }
    public function getAdd(){
        return view('admin.student.add');
    }
    public function postAdd(Request $request){
        $svInput = [
            'mssv' => ' required',
            'name' => 'required',
            'sdt' => 'required|max:10',
        ];
        $svCheck = [
            'mssv.required' => 'MSSV không được để trống',
            'name.required'=>'Họ và tên không được để trống',
            'sdt.required'=>'SDT không được để trống',
        ];
        $validator= validator::make($request->all(), $svInput, $svCheck);
        if($validator->fails()){
            return redirect()->route('student.add')->withErrors($validator)->withInput();
        }
         $user = DB::table('sinhvien')->insert([
            'mssv'=>$request->input('mssv'),
            'hoten'=>$request->input('name'),
            'sdt'=>$request->input('sdt'),
        ]);
        // return redirect()->route('student.index')->with('alert_success', 'Thêm sinh viên thành công');
        return response()->json([
            'user'=>$user,
    ]);
        
    }
    public function getEdit($id){
        $student = DB::table('sinhvien')->where('id', $id)->first();
        return view('admin.student.edit', ['student'=> $student]);
    }
    public function postEdit(Request $request, $sv){
        $svInput = [
            'mssv' => 'required',
            'name' => 'required',
            'sdt' => ' required|max:10',
        ];
        $svCheck = [
            'mssv.required'=>'MSSV không được để trống',
            'name.required'=>'Tên sinh viên không được để trống',
            'sdt.required'=>'SDT không được để trống',
        ];
        $validator = validator::make($request->all(), $svInput, $svCheck);
        if($validator->fails()){
            return redirect()->route('student.edit', ['id'=> $sv])->withErrors($validator)->withInput();
        }
        DB::table('sinhvien')->where('id', $sv)->update([
            'mssv'=>$request->input('mssv'),
            'hoten'=>$request->input('name'),
            'sdt'=>$request->input('sdt'),
        ]);
        return redirect()->route('student.index')->with('alert_success', 'Sửa sinh viên thành công');
    }
    public function getDel(Request $request, $id){
        DB::table('sinhvien')->where('id', $id)->delete();
        return redirect()->route('student.index')->with('alert_success', 'Xóa sinh viên thành công');
    }
    public function apiIndex(){
        $student = DB::table('sinhvien')->get();
        return response()->json([
            'data'=>$student,
        ]);
    }

}
