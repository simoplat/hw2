<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class HomeController extends BaseController
{


    public function list()
    {
        if (!Session::get('user_id')) {
            return redirect('login');
        }
        
        $user = User::with('immagine')->find(Session::get('user_id'));
        return view('home', [
        'username' => $user->username,
        'immagineProfilo' => $user->immagineUtente?->immagine_profilo
    ]);
    }

}