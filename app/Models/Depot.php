<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;
    protected $table = 'depots'; // Specify the table name
    protected $fillable = [
        'contribuable_id',
        'declaration_type',
        'exercice',
        'nature',
        'type',
        'bilan_actif',
        'bilan_passif',
        'etat_resultat',
        'flux_tresorerie',
        'resultat_fiscal_partiel',
        'faits_marquants',
        'autres_feuilles',
        'situation',
        'reception', // Add this line
    ];
}
