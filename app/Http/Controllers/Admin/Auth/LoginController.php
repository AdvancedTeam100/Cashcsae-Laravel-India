<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use DB;

class LoginController extends Controller
{
   use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('verifylicense')->except('logout');
        
        $this->middleware('guest:admin', ['except' => 'logout']);
    }
    

    public function login()
    {

        try
       {
        DB::connection()->getPdo(); 
		$check=DB::table('admins')->where('role_id',1)->first();
        return view('admin.auth.login', compact('check'));
        }catch(\Exception $e){
         return redirect('/verification');
        }
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (auth('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('admin.dashboard')->with('success','Logged In Successfully.');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->with('error','Credentials does not match.');
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    }
}
