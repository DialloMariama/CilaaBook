<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom',
        'description',

     ];
      /*
      *Get the user for the role.
      */
  public function users(): HasMany{
      return $this->HasMany(User::class);}
}
