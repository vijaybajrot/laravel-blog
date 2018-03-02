<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class LoginController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    protected $redirectTo = '/homepage';
    protected $redirectAfterLogout = '/login';

    public function __construct()
    {

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

	public function authenticate(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'user_group'=>'1'])) {
            // Authentication passed...
            return redirect()->intended('admin-panel/dashboard');
        }else{
            session()->flash('_auth_error',"Authenticatation Failed !");
            return redirect()->back();
        }
    }
}
