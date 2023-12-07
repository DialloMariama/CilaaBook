<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{

    use HasFactory;
    protected $fillable = [
        "titre",
        "description",
        "statut",
        "image",
        "is_deleted",
        "categorie_id",
        "porteurprojet_id",
    ];

    public function bailleurs()
    {
        return $this->belongsToMany(Bailleur::class);
    }
    public function porteurprojets()
    {
        return $this->belongsTo(Porteurprojet::class);
    }
    public function categories()
    {
        return $this->belongsTo(Categorie::class);
    }
   

}
