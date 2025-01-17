<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaisseEntreeColisItem extends Model
{
    protected $fillable = [
        "entree_colis",
        "site",
        "autre",
        "colis",
        "nature",
        "scelle",
        "nbre_colis",
        "montant",
        'valeur_colis_xof_entree', 'device_etrangere_dollar_entree', 'device_etrangere_euro_entree', 'pierre_precieuse_entree',
    ];

    public function sites()
    {
        return $this->belongsTo('App\Models\Commercial_site', 'site', 'id')
            ->with("clients");
    }
}
