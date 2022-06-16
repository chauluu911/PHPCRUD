<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Carbon\Carbon;
use Mail;



class AuthController extends Controller
{
    public function getLogin(){
        $user = DB::table('users')->get();
        return view('admin.auth.login', ['user' => $user]);
    }
    public function postLogin(Request $request)
    {
        $validateAuth = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $auth = [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được bỏ trống',
        ];
        $validator = validator::make($request->all(), $validateAuth, $auth);
        if($validator->fails()){
            return redirect()->route('login')->withErrors($validator)->withInput();
        }
        // $user= DB::table('user')->where('email', $request->email)->first;
        // if($user && password_verify($request -> pasword, $user->password)){
        //     $request->sesion()->put('auth', $user);
        //     return redirect()->route('student.index')->with('alert_success', 'Đăng nhập thành công');
        // } return redirect()->route('login')->with('alert_error', 'Tài khoản hoặc mật khẩu không đúng');
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard.index');
        }
        return redirect()->route('login')->with('alert_error', 'Tài khoản hoặc mật khẩu không đúng');
        
    }
    public function getReg(){
        return view('admin.auth.register');
    }
    public function postReg(Request $request)
    {
        $validateAuth = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'min:6|required_with:cfpassword|same:confirmpassword',
            'confirmpassword' => 'required|min:6',
        ];
        $auth = [
            'name.required' => 'Họ Và Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có 6 kí tự trở lên',
            'confirmpassword.required' => 'Mật khẩu xác nhận không được để trống',
            'confirmpassword.min' => 'Mật khẩu phải có 6 kí tự trở lên',
        ];
        $validator = validator::make($request->all(), $validateAuth, $auth);
        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->password),
            'role_id'=> '2',
        ];
        DB::table('users')->insert($data);
        return redirect()->route('login')->with('alert_success', 'bạn đã đăng ký thành công');
    }
    public function getLogout()
    {
        Session::flush();
        return redirect()->route('login');
    }
    public function getReset(){

        return view('admin.auth.resetpassword');
    }
    public function postReset(Request $request){
        $validate =[
            'email' => 'required|email',
        ];
        $validateCheck = [
            'email.email'=>'email không đúng định dạng',
            'email.required'=>'email không được bỏ trống',
        ];
        $validator = validator::make($request->all(), $validate, $validateCheck);
        if($validator->fails()){
            return redirect()->route('resetpassword')->withErrors($validator)->withInput();
        }
        $token = Str::random(64);
        $user = DB::table('users')->where('email', $request->email)->first();
        if(!$user){
            return redirect()->route('resetpassword')->with('alert_error', 'Không tồn tại user');
        }

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('admin.email.emailreset', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Click vào link để thay đổi mật khẩu của bạn');
        });

        return redirect()->route('resetpassword')->with('alert_success', 'Chúng tôi đã gửi email thay đổi mật khẩu cho bạn!');
    }
    public function getResetForm() { 
        return view('admin.auth.resetpasswordform');
     }
     public function postResetForm(Request $request, $token)
      {
          $request->validate([
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([ 
                                'token' => $token
                              ])
                              ->first();
              $user = DB::table('users')->where('email', $updatePassword->email)->limit(1);
              if(!$user) {
                return redirect()->route('resetpassword')->with('alert_error', 'Không tồn tại user');
              }                  
              $user->update(['password' => Hash::make($request->password)]);
              DB::table('password_resets')->where('token', $token)->delete();
              return redirect()->route('login')->with('alert_success', 'Bạn đã thay đổi mật khẩu thành công');
      

     }
     
 
}
