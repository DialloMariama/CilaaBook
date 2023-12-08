<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Porteurprojet extends Model
{
    use HasFactory,HasFactory, Notifiable;
    protected $fillable = [
        "nom",
        "adresse",
        "email",
        "password",
        "telephone",
      
    ];
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
