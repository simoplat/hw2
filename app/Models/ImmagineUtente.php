<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class ImmagineUtente extends Model
{
    protected $table = 'immaginiutente';
    protected $primaryKey = 'id_utente';
    public $incrementing = false;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utente');
    }
}

