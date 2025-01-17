<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteDepartTournee extends Model
{
    protected $fillable = [
        'site', 'type', 'tdf', 'idTourneeDepart', 'caisse', 'montant', 'autre', 'bordereau',
        'nature', 'client', 'nbre_colis', 'numero_scelle', 'montant_regulation', 'colis', 'valeur_colis', 'numero', 'valeur_autre',
        'valeur_colis_xof', 'device_etrangere_dollar', 'device_etrangere_euro', 'pierre_precieuse',
        'valeur_colis_xof_arrivee', 'device_etrangere_dollar_arrivee', 'device_etrangere_euro_arrivee', 'pierre_precieuse_arrivee', 'numero_arrivee', 'nbre_colis_arrivee', 'colis_arrivee',
        'valeur_colis_xof_transport_depart', 'device_etrangere_dollar_transport_depart', 'device_etrangere_euro_transport_depart', 'pierre_precieuse_transport_depart', 'numero_transport_depart', 'nbre_colis_transport_depart',
    ];

    public function sites()
    {
        return $this->belongsTo('App\Models\Commercial_site', 'site', 'id')->with("clients");
    }

    public function tournees()
    {
        return $this->belongsTo('App\Models\DepartTournee', 'idTourneeDepart', 'id');
    }
}
