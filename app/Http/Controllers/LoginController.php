<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class LoginController extends BaseController
{
    public function register_form()
    {
        if (Session::get('user_id ')) {
            return redirect('home');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('register')->with('error', $error);
    }

    public function do_register()
    {
        if (strlen(request('username')) == 0 || strlen(request('password')) == 0 || strlen(request('name')) == 0 || strlen(request('surname')) == 0) 
        {
            Session::put('error', 'empty_fields');
            return redirect('register')->withInput();
        } else if (request(('password')) != request('confirm_password')) {
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

        Session::get('user_id', $user->id);

        return redirect('home');
    }
}

