<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Iscrizione;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

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
            'autore.immagine' 
        ])
            ->whereHas('autore.followers', function ($query) use ($user) {
                $query->where('follower_id', $user->id);
            })
            ->orderByDesc('id_post')
            ->get()
            ->map(function ($post) {
                return [
                    'id_post' => $post->id_post,
                    'title' => $post->title,
                    'percorsoMedia' => $post->percorsoMedia,
                    'canale' => $post->autore->username,
                    'immagine_profilo' => $post->autore->immagine?->immagine_profilo,
                    'categoria' => $post->categoria,
                ];
            });

        return response()->json($posts);
    }


    public function fetchCategories()
    {

        if (!Session::get('user_id')) {
            return [];
        }

        $user = User::find(Session::get('user_id'));

        $seguitiIds = Iscrizione::where('follower_id', $user->id)->pluck('seguito_id');

        if ($seguitiIds->isEmpty()) {
            return;
        }

        $categorie = Post::whereIn('id_autore', $seguitiIds)
            ->whereNotNull('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        if ($categorie->isEmpty()) {
            return;
        }

        return response()->json($categorie);
    }


    public function fetchChannels()
    {
        if (!Session::get('user_id')) {
            return [];
        }

        $user = User::find(Session::get('user_id'));

        $channels = $user->seguiti() 
            ->leftJoin('ImmaginiUtente as imm', 'users.id', '=', 'imm.id_utente')
            ->orderBy('users.username')
            ->get([
                'users.id',
                'users.username',
                'users.name',
                'users.surname',
                'imm.immagine_profilo'
            ])
            ->map(function ($entry) {
                return [
                    'channelid' => $entry->id,
                    'channelname' => $entry->username,
                    'name' => $entry->name,
                    'surname' => $entry->surname,
                    'immagine_profilo' => $entry->immagine_profilo,
                ];
            });

        return response()->json($channels);


    }

    public function fetchNotification()
    {
        if (!Session::get('user_id')) {
            return [];
        }

        $user = User::find(Session::get('user_id'));


        $followersUsernames = $user->followers()->pluck('username');

        return response()->json([
            'followers' => $followersUsernames
        ]);



    }


}