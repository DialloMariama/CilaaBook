<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porteurprojet extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
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
