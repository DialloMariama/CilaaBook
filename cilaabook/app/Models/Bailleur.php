<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bailleur extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "adresse",
        "email",
        "password",
        "statut",
        "telephone",
    ];
    public function projets()
    {
        return $this->belongsToMany(Projet::class);
    }
}
