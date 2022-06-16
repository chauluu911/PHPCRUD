<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class GiangVienController extends Controller
{
    public function getIndexGv(Request $request){
        $teacher = DB::table('giangvien')->get();
        return view ('admin.teacher.index', ['list' => $teacher]);
    }
    public function getAddGv(){
        return view('admin.teacher.addgv');
    }
    public function postAddGv(Request $request){
        $gvInsert = [
            'magv'=>'required',
            'name' => 'required',
            'sdt' => 'required|max:10',
            'giangday' => 'required',
        ];
        $gv = [
            'magv.required'=>'Mã số giảng viên không được bỏ trống',
            'name.required' => 'Tên giảng viên không được bỏ trống',
            'sdt.required'=>'sdt giảng viên không được bỏ trống',
            'giangday.required'=>'Môn học giảng dạy không được bỏ trống',
        ];
        $validator= validator::make($request->all(), $gvInsert, $gv);
        if($validator->fails()){
            return redirect()->route('teacher.addgv')->withErrors($validator)->withInput();
        }
        $data = [
            'magv'=>$request->input('magv'),
            'tengv'=>$request->input('name'),
            'sdt'=>$request->input('sdt'),
            'giangday'=>$request->input('giangday'),
        ];
        DB::table('giangvien')->insert($data);
        return redirect()->route('teacher.index')->with('alert_success', 'Thêm Giảng Viên Thành Công');
    }
    public function getEditGv($id)
    {
        $giangvien = DB::table('giangvien')->where('id', $id)->first();
        return view('admin.teacher.editgv', ['teacher' => $giangvien]);
    }
    public function updateGv(Request $request, $gv){
        $validateGV = [
            'magv'=>'required',
            'name'=>'required',
            'sdt'=>'required|max:10',
            'giangday'=>'required',
        ];  
        $validategv = [
            'magv.required'=>'Mã giảng viên không được để trống',
            'name.required'=>'Tên giảng viên không được để trống',
            'sdt.required'=>'SDT không được để trống',
            'giangday.required'=>'Tên môn học không được để trống',
        ];
        $validator= validator::make($request->all(), $validateGV, $validategv);
        if($validator->fails()){
            return redirect()->route('teacher.editgv', ['id'=> $gv])->withErrors($validator)->withInput();
        }
        $dataGV = [
            'magv' => $request->input('magv'),
            'tengv' =>$request->input('name'),
            'sdt'=>$request->input('sdt'),
            'giangday'=>$request->input('giangday'),
        ];
        DB::table('giangvien')->where('id', $gv)->update($dataGV);
        return redirect()->route('teacher.index', ['id'=>$gv])->with('alert_success', 'Sửa giảng viên thành công');
    }
    public function getDel($id){
        DB::table('giangvien')->where('id', $id)->delete();
        return redirect()->route('teacher.index')->with('alert_success', 'Xóa giảng viên thành công');
    }
    public function apiIndex(){
        $teacher = DB::table('giangvien')->get();
        return response()->json([
            'data'=>$teacher,
        ]);
    }
}
