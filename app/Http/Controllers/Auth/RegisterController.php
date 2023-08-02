<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function register(){
        return view('client.auth.register');
    }
    public function store(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required'
        ];
        $messages = [
            'name.required' => 'Name is required.',
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
    
        // Validation succeeded, create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    
        // Check if user creation succeeded
        if ($user) {
            // Optionally, flash a success message
            // Session::flash('success', 'User created successfully');
    
            // Redirect to login_show route
            return redirect()->route('login_show');
        }
    }
    

    //admin
    public function index(){
        $user =User::all();
        return view('admin.users.index', compact('user'));
    }
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('user')->with('success',' Xóa thành công.');
    }
}
