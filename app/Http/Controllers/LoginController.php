<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class LoginController extends BaseController
{
    public function register_form()
    {
        $error = Session::get('error');
        Session::forget('error');
        return view('register')->with('error', $error);
    }

    public function do_register()
    {
        if (strlen((request('username')) == 0) || strlen(((request('password')))) == 0) {
            Session::put('error', 'empty_fields');
            return redirect('register')->withInput();
        } else if (request(('password')) != request('confirm_password')) {
            Session::put('error', 'bad_passwords');
            return redirect('register')->withInput();
        } else if (User::where('username', request('username'))->first()) {
            Session::put('error', 'existing');
            return redirect('register')->withInput();
        }
        return "ok";
    }
}

