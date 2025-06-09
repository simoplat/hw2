<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Iscrizione;

class UserController extends BaseController
{

    public function getUserPage($username)
    {

        if (!Session::get('user_id')) {
            return redirect('login');
        }

        $user = User::where('username', $username)->first();
        if (!$user) {
            abort(404);
        }
        return view('User')->with('channel', $username);
    }

    public function fetchChannelContent($channel)
    {

        if (!Session::get('user_id')) {
            return redirect('login');
        }
        

        $user = User::where('username', $channel)->first();
        if(!$user) return;

        // Recupera l'immagine utente (con fallback)
        $immagini = $user->immagine;

        // Recupera i post dell’utente con info utente
        $posts = $user->posts()
        ->with(['autore']) // se necessario per username
        ->orderByDesc('id_post')
        ->get()
        ->map(function ($post) {
            return [
                    'id_post' => $post->id_post,
                    'id_autore' => $post->id_autore,
                    'title' => $post->title,
                    'contenuto' => $post->contenuto,
                    'percorsoMedia' => $post->percorsoMedia,
                    'categoria' => $post->categoria,
                    'username' => $post->user->username ?? '',
                ];
            });
            
            // Profilo con fallback immagine
        $profilo = [
            'immagine_profilo' => $immagini->immagine_profilo ?? 'Media/Portrait_Placeholder.png',
            'immagine_copertina' => $immagini->immagine_copertina ?? 'Media/placeholder.jpg',
            'name' => $user->name ?? '',
            'surname' => $user->surname ?? '',
            'username' => $user->username ?? '',
        ];

        return response()->json([
            'profilo' => $profilo,
            'post' => $posts,
        ]);

    }
}