<?php

namespace App\Http\Controllers;

use App\Centre;
use App\Centre_regional;
use App\Vehicule;
use App\VidangeAssurance;
use Illuminate\Http\Request;

class VidangeAssuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicules = Vehicule::all();
        $centres = Centre::all();
        $centres_regionaux = Centre_regional::all();
        $vidanges = VidangeAssurance::all();
        return view('/transport/entretien-vehicule/vidange-assurance.index',
            compact('vehicules', 'centres', 'centres_regionaux', 'vidanges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vignette = new VidangeAssurance([
            'date' => $request->get('date'),
            'idVehicule' => $request->get('idVehicule'),
            'centre' => $request->get('centre'),
            'centreRegional' => $request->get('centreRegional'),
            'dateRenouvellement' => $request->get('dateRenouvellement'),
            'prochainRenouvellement' => $request->get('prochainRenouvellement'),
            'montant' => $request->get('montant'),
        ]);
        $vignette->save();
        return redirect('/vidange-transport')->with('success', 'Carte de transport enregistré!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
