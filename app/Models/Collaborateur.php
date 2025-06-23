<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborateur extends Model
{
    protected $fillable = [
        'civilité', 'nom', 'prenom', 'email', 'telephone', 'date_naissance', 'adresse', 'ville', 'photo', 'password'
    ];
}
