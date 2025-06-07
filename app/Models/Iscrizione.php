<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class Iscrizione extends Model
{
    protected $table = 'iscrizione';
    public $incrementing = false; // perché non ha colonna "id" classica
    public $timestamps = false;

    protected $fillable = ['follower_id', 'seguito_id'];
}
