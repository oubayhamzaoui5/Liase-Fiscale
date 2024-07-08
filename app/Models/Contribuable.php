<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contribuable extends Model implements AuthenticatableContract
{
    use Authenticatable, Notifiable, HasFactory;

    protected $fillable = [
        'matricule_fiscale', 'raison_sociale', 'adresse', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function depots(): HasMany
    {
        return $this->hasMany(Depot::class, 'contribuable_id');
    }
}
