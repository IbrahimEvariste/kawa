<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaisseServiceOperatrice extends Model
{
    protected $fillable = [
        'caisseService',
        'operatriceCaisse',
        'numeroOperatriceCaisse',
        'operatriceCaisseBox',
        'heureArrivee',
        'heureDepart',
    ];

    public function operatrice()
    {
        return $this->belongsTo('App\Models\Personnel', 'operatriceCaisse', 'id');
    }
}
