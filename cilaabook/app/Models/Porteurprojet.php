<?php
namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Porteurprojet as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Porteurprojet extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        "nom",
        "adresse",
        "email",
        "image",
        "password",
        "telephone",
    ];
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
