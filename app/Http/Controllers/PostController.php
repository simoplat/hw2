<?php

namespace App\Http\Controllers;

use App\Models\Commento;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Iscrizione;
use Laravel\Pail\ValueObjects\Origin\Console;
use Illuminate\Http\Request;


class PostController extends BaseController
{

    public function index($id_post)
    {

        if (!session('user_id')) {
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

        if (!session('user_id')) {
            return redirect('login');
        }


        if (!is_numeric($id_post)) {
            return response()->json(['error' => 'ID post non valido'], 400);
        }

        $userid = Session::get('user_id');

        $post = Post::with([
            'autore.immagine',
            'preferiti' => function ($query) use ($userid) {
                $query->where('id_utente', $userid); 
            }
        ])
            ->where('id_post', $id_post)
            ->first();


        $autore = $post->autore;
        $immagini = $autore->immagine;




        
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

    public function aggiornaCommenti($id_post)
    {

        if (!session('user_id')) {
            return redirect('login');
        }

        $comments = Commento::with([
            'autore' => function ($query) {
                $query->select('id', 'username');
            }
        ])
            ->where('id_post', $id_post)
            ->orderBy('id_commento', 'DESC')
            ->get(['id_commento', 'id_autore', 'testo']);


        $formattedComments = $comments->map(function ($comment) {
            return [
                'username' => $comment->autore->username,
                'testo' => $comment->testo
            ];
        });

        return response()->json($formattedComments);


    }


    public function togglePreferito(Request $request)
    {

        if (!session('user_id')) {
            return redirect('login');
        }

        $user = User::find(Session::get('user_id'));


        $postId = $request->id_post;

        $isPreferito = $user->checkPreferito()->where('id_post', $postId)->exists();
        
        if ($isPreferito) {
            // Rimuovi dai preferiti
            $user->preferiti()->detach($postId);
            return response()->json(['preferito' => false]);
        } else {
            // Aggiungi ai preferiti
            $user->preferiti()->attach($postId);
            return response()->json(['preferito' => true]);
        }
    }

    public function aggiungiCommento(Request $request){

         if (!session('user_id')) {
            return redirect('login');
        }

        $user = User::find(Session::get('user_id'));

        $commento = new Commento();
        $commento->id_autore = $user->id;
        $commento->id_post = $request->id_post;
        $commento->testo = $request->commento;
        $commento->save();
        return response()->json(['success'=> true]);
        
    }


}