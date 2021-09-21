<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegulationFacturation extends Model
{
    protected $table = 'regulation_facturations';

    protected $fillable = [
        'date',
        'numero',
        'centre',
        'centre_regional',
        'montantTotal',
        'client',
    ];

}
