<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Iscrizione;
use Laravel\Pail\ValueObjects\Origin\Console;

class PostController extends BaseController
{

    public function index($id_post)
    {

        if (!Session::get('user_id')) {
            return redirect('login');
        }

        $post = Post::where('id_post', $id_post)->first();
        if (!$post) {
            abort(404);
        }
        return view('post')->with('id_post', $id_post);
    }

    public function fetchPost($id_post)
    {

        if (!Session::get('user_id')) {
            return redirect('login');
        }


        if (!is_numeric($id_post)) {
            return response()->json(['error' => 'ID post non valido'], 400);
        }

        $userid = Session::get('user_id');

        $post = Post::with([
            'autore.immagine', // autore con immagine profilo
            'preferiti' => function ($query) use ($userid) {
                $query->where('id_utente', $userid); // solo i preferiti di questo utente
            }
        ])
            ->where('id_post', $id_post)
            ->first();


        $autore = $post->autore;
        $immagini = $autore->immagine;




        // JSON di risposta
        return response()->json([
            'id_post' => $post->id_post,
            'title' => $post->title,
            'contenuto' => $post->contenuto,
            'percorsoMedia' => $post->percorsoMedia,
            'categoria' => $post->categoria,
            'autore' => $autore->username ?? '',
            'name' => $autore->name ?? '',
            'surname' => $autore->surname ?? '',
            'immagine_profilo' => $immagini->immagine_profilo ?? 'Media/Portrait_Placeholder.png',
            'immagine_copertina' => $immagini->immagine_copertina ?? 'img/Media/placeholder.jpg',
            'preferito' => $post->preferiti->isNotEmpty()
        ]);
    }


}