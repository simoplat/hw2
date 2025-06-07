<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;



class Commento extends Model
{
    protected $table = 'commenti';
    protected $primaryKey = 'id_commento';

    protected $fillable = [
        'testo'
    ];

    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function autore()
    {
        return $this->belongsTo(User::class, 'id_autore');
    }
}
