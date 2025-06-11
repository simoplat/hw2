<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\EncodedHtmlString;



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


    public function doSomething()
    {
        if (!session("user_id")) {
            return redirect("login");
        }

    }

}