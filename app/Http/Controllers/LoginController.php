<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    public function login_form()
    {
        if (Session::get('user_id')) {
            return redirect('home');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('login')->with('error', $error);
    }


    public function register_form()
    {
        if (Session::get('user_id')) {
            return redirect('home');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('register')->with('error', $error);
    }

    public function do_login()
    {
        if(Session::get('user_id')) {
            return redirect('home');
        }


        if (strlen(request('username')) == 0 || strlen(request('password')) == 0) 
        {
            Session::put('error', 'empty_fields');
            return redirect('login')->withInput();

        } 

        $user = User::where('username', request('username'))->first();

        if(!$user || !password_verify(request('password'), $user->password)){
            Session::put('error', 'wrong');
            return redirect('login')->withInput();
        }
         
        Session::put('user_id', $user->id);
        return redirect('home');
    }


    public function do_register()
    {
        if (strlen(request('username')) == 0 || strlen(request('password')) == 0 || strlen(request('name')) == 0 || strlen(request('surname')) == 0) 
        {
            Session::put('error', 'empty_fields');
            return redirect('register')->withInput();
        } else if (request('password') != request('confirm_password')) {
            Session::put('error', 'bad_passwords');
            return redirect('register')->withInput();
        } else if (User::where('username', request('username'))->first()) {
            Session::put('error', 'username_existing');
            return redirect('register')->withInput();
        } else if (User::where('email', request('email'))->first()) {
            Session::put('error', 'email_existing');
            return redirect('register')->withInput();
        }

        $user = new User;
        $user->username = request("username");
        $user->password = password_hash(request("password"),PASSWORD_BCRYPT);
        $user->email = request("email");
        $user->name = request("name");
        $user->surname = request("surname");

        $user->save();

        Session::put('user_id', $user->id);

        return redirect('home');
    }


    public function logout(){
        Session::flush();
        return redirect('index');
    }


    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true, 'type' => 'email']);
        } else {
            return response()->json(['exists' => false, 'type' => 'email']);
        }
    }

    public function checkUsername(Request $request)
    {
        $username = $request->username;
        $user = User::where('username', $username)->first();

        if ($user) {
            return response()->json(['exists' => true, 'type' => 'username']);
        } else {
            return response()->json(['exists' => false, 'type' => 'username']);
        }
    }

}


