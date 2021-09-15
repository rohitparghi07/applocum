<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  Session;
use App\User;

// use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{

    /**
     *Name : viewLoginForm
     *
     * @desc : login form view
     *  
    */
    public function viewLoginForm() {
        return view('admin.login.login');
    }

    /**
     *Name : viewLoginForm
     *
     * @desc : login form view
     *  
    */
    public function hasLogin(Request $request) {
  
        //validation       
        $request->validate(
                            [
                                'email' => 'required',
                                'password' => 'required',
                            ],
                            [
                                'email.required'=>'Please enter user name',
                                'password.required'=>'Please provide password',
                            ]);
                            
            $credentials = $request->only('email', 'password');
         
            if (Auth::attempt($credentials)) {
                
                session()->put("user",auth()->user()->email);

                // Authentication passed...
                return redirect()->route('dashboard');
            }
              
            return redirect()->route("login")->withError('You have entered invalid credentials')->withInput();
    }

    /**
     *Name : logout
     *
     * @desc :logout all session
     *  
    */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route("login");
    }

   
}
