<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;

class HomeController extends BaseController
{


    public function home()
    {
        if (!Session::get('user_id')) {
            return redirect('login');
        }
               
        $user = User::with('immagine')->find(Session::get('user_id'));
        return view('home', [
        'username' => $user->username,
        'immagineProfilo' => $user->immagine?->immagine_profilo
    ]);

    }


    public function getFeed()
    {

         if (!Session::get('user_id')) {
            return [];
        }
     
        $user = User::find(Session::get('user_id'));

        $posts = Post::with([
            'autore:id,username',
            'autore.immagine' // carica l'immagine dell'autore
        ])
        ->whereHas('autore.followers', function ($query) use ($user) {
            $query->where('follower_id', $user->id);
        })
        ->orderByDesc('id_post')
        ->get()
        ->map(function ($post) {
            return [
                'id_post'          => $post->id,
                'title'            => $post->title,
                'percorsoMedia'    => $post->percorsoMedia,
                'canale'           => $post->autore->username,
                'immagine_profilo' => $post->autore->immagine?->immagine_profilo,
                'categoria'        => $post->categoria,
            ];
        });

        return response()->json($posts);
    }
}