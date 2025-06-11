<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

use Illuminate\Routing\Controller as BaseController;



class ApiController extends BaseController
{

    public function youtubeAPI(Request $request)
    {

        if (!session('user_id')) {
            return redirect('login');
        }

        $API_KEY = env('YOUTUBE_KEY');
        $ricerca = urlencode($request->q);
        $maxResults = 20;


        $apiUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&q={$ricerca}&type=video&maxResults={$maxResults}&key={$API_KEY}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }

    public function spotifyAPI()
    {
        if (!session("user_id")) {
            return redirect("login");
        }


        $client_id = env('SPOTIFY_CLIENT_ID'); // ID client Spotify
        $client_secret = env('SPOTIFY_CLIENT_SECRET'); // Segreto client Spotify
        $nomeUtente = env('SPOTIFY_ID'); // Nome utente Spotify

        // ACCESS TOKEN
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Eseguo la POST
        curl_setopt($ch, CURLOPT_POST, 1);
        # Setto body e header della POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret)));
        $token = json_decode(curl_exec($ch), true);
        curl_close($ch);

        //$query = urlencode($_GET["q"]);
        //$url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
        $url = "https://api.spotify.com/v1/users/{$nomeUtente}/playlists?limit=20";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Imposto il token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token['access_token']));
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;

    }


    public function dbAction(Request $request)
    {
        if (!session("user_id")) {
            return redirect("login");
        }

        $title = $request->title;
        $channel = $request->channel;
        $wallpaper = $request->wallpaper;
        $description = $request->description;


        // Check if user already exists
        $user = User::where('username', $channel)->first();
        if (!$user) {
            $user = new User;
            $user->username = $channel;
            $user->password = 'password';
            $user->email = 'email';
            $user->name = $channel;
            $user->surname = 'surname';
            $user->save();
        }

        // Check if post already exists for this user with the same title
        $post = Post::where('title', $title)
                ->where('id_autore', $user->id)
                ->first();

        if (!$post) {
            $post = new Post;
            $post->title = $title;
            $post->contenuto = $description;
            $post->percorsoMedia = $wallpaper;
            $post->categoria = 'Caricamenti';
            $post->id_autore = $user->id;
            $post->save();
        }


        // Use the correct primary key field for Post
        return redirect()->route('post.show', ['id_post' => $post->id ?? $post->id_post]);
        
    }


}