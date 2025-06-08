<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Iscrizione;

class UserController extends BaseController{

    public function getUserPage($username){


        return view('User')->with('User', $username);
    }

}