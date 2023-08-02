<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        
        return view('client.auth.login');
    }
    public function login(Request $request)
    {
            //đăng nhập thành công
            // dd($request);
            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];
            $messages = [
                'email.required' => 'Email is required.',
                'email.email' => 'Email must be a valid email address.',
                'password.required' => 'Password is required.',
            ];
        
            $validator = Validator::make($request->all(), $rules, $messages);
        
            // Check if validation fails
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator) // Send validation errors to the view
                    ->withInput(); // Fill the form with the old input
            }
            if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                if(auth()->user()->role == 'admin'){
                    return redirect()->route('home_admin');
                }else{
                    return redirect()->route('home');
                }
                
            } else {
                Session::flash('error','Nhập sai tài kho !!!!');
                return redirect()->route('login_show');
            }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    

}
