<?php

namespace App\Http\Controllers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Iscrizione;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    public function getUserPage($username)
    {

        if (!session('user_id')) {
            return redirect('login');
        }

        $loggedUser = User::find(Session::get('user_id'));
        if (!$loggedUser) {
            abort(403);
        }

        $targetUser = User::where('username', $username)->first();
        if (!$targetUser) {
            abort(404);
        }

        if ($targetUser->id === $loggedUser->id) {
            return view('user')->with([
                'channel' => $targetUser->username,
                'isFollowing' => 'TeStesso',
                'name' => $targetUser->name ?? '',
                'surname' => $targetUser->surname ?? '',
            ]);
        }

        $isFollowing = $loggedUser->seguiti()->where('users.id', $targetUser->id)->exists();

        return view('user')->with([
            'channel' => $targetUser->username,
            'isFollowing' => $isFollowing,
            'name' => $targetUser->name ?? '',
            'surname' => $targetUser->surname ?? '',
        ]);

    }

    public function fetchChannelContent($channel)
    {

        if (!session('user_id')) {
            return redirect('login');
        }


        $user = User::where('username', $channel)->first();
        if (!$user)
            return;


        $immagini = $user->immagine;


        $posts = $user->posts()
            ->with(['autore'])
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
                    'elimina' => $post->id_autore === session('user_id'),
                ];
            });


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

    /* public function checkChannel(Request $request)
    {
        if (!session('user_id')) {
            return redirect('login');
        }

        $user = User::find(Session::get('user_id'));

        $targetUsername = $request->user;

        if (!$targetUsername) {
            return response()->json(['iscritto' => false]);
        }

        $targetUser = User::where('username', $targetUsername)->first();

        if (!$targetUser) {
            return response()->json(['iscritto' => false]);
        }

        if ($targetUser->id === $user->id) {
            return response()->json(['iscritto' => 'TeStesso']);
        }

        $isFollowing = $user->seguiti()->where('users.id', $targetUser->id)->exists();

        return response()->json(['iscritto' => $isFollowing]);
    }
 */

    public function toggleIscritto(Request $request)
    {

        if (!session('user_id')) {
            return redirect('login');
        }

        $user = User::find(Session::get('user_id'));

        $targetUsername = $request->user;


        if (!$targetUsername) {
            return response()->json(['error' => 'Username del canale non fornito'], 400);
        }

        $targetUser = User::where('username', $targetUsername)->first();
        if (!$targetUser) {
            return response()->json(['error' => 'Utente (canale) non trovato'], 404);
        }

        if ($targetUser->id === $user->id) {
            return response()->json(['error' => 'Non puoi iscriverti a te stesso'], 400);
        }

        //già iscritto
        $isIscritto = $user->seguiti()->where('users.id', $targetUser->id)->exists();

        if ($isIscritto) {
            // Disiscrizione
            $user->seguiti()->detach($targetUser->id);
            return response()->json(['iscritto' => false]);
        } else {
            // Iscrizione
            $user->seguiti()->attach($targetUser->id);
            return response()->json(['iscritto' => true]);
        }
    }


    public function deletePost($id_post)
    {
        if (!session('user_id')) {
            return redirect('login');
        }

        $post = Post::where('id_post', $id_post)
            ->where('id_autore', session('user_id'))
            ->first();

        if (!$post) {
            return response()->json(['error' => 'Post non trovato'], 404);
        }

        if ($post->id_autore !== session('user_id')) {
            return response()->json(['error' => 'Non hai i permessi per eliminare questo post'], 403);
        }

        $post->delete();

        return response()->json(['success' => true]);
    }

}