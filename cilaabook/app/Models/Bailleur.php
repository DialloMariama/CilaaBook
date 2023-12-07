<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Bailleur as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Bailleur extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = [
        "nom",
        "adresse",
        "email",
        "image",
        "password",
        "statut",
        "telephone",
    ];
    public function projets()
    {
        return $this->belongsToMany(Projet::class);
    }
}