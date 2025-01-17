<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComptabiliteEntreeCaisse extends Model
{
    protected $fillable = [
        'date',
        'somme',
        'motif',
        'deposant',
        'service',
        'centre',
        'centre_regional',
        'mouvement',
        'justification',
        'montant_justifie',
        'montant_non_justifie',
    ];
}
