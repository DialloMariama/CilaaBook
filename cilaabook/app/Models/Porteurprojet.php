<?php
namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Porteurprojet extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    use HasFactory,HasFactory, Notifiable;
    protected $fillable = [
        "nom",
        "adresse",
        "email",
        "image",
        "password",
        "telephone",
        "is_deleted",

      
    ];
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
