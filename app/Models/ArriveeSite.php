<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArriveeSite extends Model
{
    protected $fillable = [
        'noTournee',
        'site',
        'dateArrivee',
        'heureArrivee',
        'debutOperation',
        'finOperation',
        'tempsOperation'
        /*'heureArrivee',
        'kmArrivee',
        'observation',
        'noBordereau',
        'centre',
        'centre_regional',*/
    ];

    public function tournees()
    {
        return $this->belongsTo('App\Models\DepartTournee', 'noTournee', 'id');
    }

    public function sites()
    {
        return $this->belongsTo('App\Models\Commercial_site', 'site', 'id');
    }
}
