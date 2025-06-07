<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;


class Preferito extends Model
{
    protected $table = 'preferiti';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id_utente', 'id_post'];
}
