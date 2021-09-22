<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VidangeCourroie extends Model
{
    protected $fillable = [
        'date',
        'idVehicule',
        'kmActuel',
        'prochainKm',
        'courroie',
        'courroieMarque',
        'courroieKm',
        'courroieFournisseur',
        'courroieMontant'];
}
