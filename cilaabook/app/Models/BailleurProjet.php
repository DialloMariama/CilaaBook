<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BailleurProjet extends Model
{
    use HasFactory;
    protected $fillable = [
        "bailleur_id",
        "projet_id",
    ];
   
}
