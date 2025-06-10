<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'email', 'name', 'surname'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_autore');
    }

    public function commenti()
    {
        return $this->hasMany(Commento::class, 'id_autore');
    }

    public function immagine()
    {
        return $this->hasOne(ImmagineUtente::class, 'id_utente');
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'Iscrizione', 'seguito_id', 'follower_id');
    }

    public function seguiti()
    {
        return $this->belongsToMany(User::class, 'Iscrizione', 'follower_id', 'seguito_id');
    }



    public function preferiti()
    {
        return $this->belongsToMany(Post::class, 'Preferiti', 'id_utente', 'id_post');
    }

    public function checkPreferito()
{
    return $this->hasMany(Preferito::class, 'id_utente', 'id');
}

}
