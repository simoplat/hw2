<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $table = 'post';

    protected $primaryKey = 'id_post';

    protected $fillable = [
        'id_autore',
        'title',
        'contenuto',
        'percorsoMedia',
        'categoria'
    ];

    public function autore()
    {
        return $this->belongsTo(User::class, 'id_autore');
    }

    public function preferiti()
    {
        return $this->hasMany(Preferito::class, 'id_post');
    }
}
