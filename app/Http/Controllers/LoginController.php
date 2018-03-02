<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class LoginController extends Controller
{
	public function authenticate(Request $request)
    {
    	// user_group = 1 (is Admin) 
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'user_group'=>'1'])) {
            // Authentication passed...
            return redirect()->intended('home');
        }else{
        }
    }
}
