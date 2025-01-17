<?php

namespace App\Http\Controllers;

use App\Models\CaisseSortieColis;
use App\Models\CaisseSortieColisItem;
use App\Models\Centre;
use App\Models\Centre_regional;
use App\Models\Commercial_site;
use App\Models\DepartTournee;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CaisseSortieColisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $centres = Centre::all();
        $centres_regionaux = Centre_regional::all();
        $agents = DB::table('personnels')->where('fonction', 'like', '%convoyeur%')->get();
        $chefBords = DB::table('personnels')->where('fonction', 'like', '%convoyeur%')->get();
        $sites = Commercial_site::with("clients")->get();
        $numero = DB::table('caisse_entree_colis')->max('id') + 1 . '-' . date('Y-m-d');
        $tournees = DepartTournee::with('agentDeGardes')->with('chefDeBords')->with('chauffeurs')->with('vehicules')->get();
        return view('/caisse/sortie-colis.index',
            compact('centres', 'centres_regionaux', 'numero', 'sites', 'agents', 'chefBords', 'tournees'));
    }

    public function liste(Request $request)
    {
        $debut = $request->get("debut");
        $fin = $request->get("fin");
        $colis = CaisseSortieColis::with("items")->get();
        if (isset($debut) && isset($fin)) {
            $colis = CaisseSortieColis::all()->whereBetween('date', [$debut, $fin]);
        }
        return view('/caisse/sortie-colis.liste', compact('colis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = new CaisseSortieColis([
            'date' => $request->get("date"),
            'heure' => $request->get("heure"),
            'centre' => $request->get("centre"),
            'centre_regional' => $request->get("centre_regional"),
            'totalMontant' => $request->get("totalMontant"),
            'totalColis' => $request->get("totalColis"),
            'noTournee' => $request->get("noTournee"),
            'receveur' => $request->get("receveur"),
        ]);
        $data->save();

        $site = $request->get("site");
        $scelle = $request->get("scelle");
        $nbre_colis = $request->get("nbre_colis");
        $colis =  $request->get("colis");
        $valeur_colis_xof = $request->get("valeur_colis_xof");
        $device_etrangere_dollar = $request->get("device_etrangere_dollar");
        $device_etrangere_euro = $request->get("device_etrangere_euro");
        $pierre_precieuse = $request->get("pierre_precieuse");

        if (!empty($site) && !empty($nbre_colis)) {
            for ($i = 0; $i < count($nbre_colis); $i++) {
                $item = new CaisseSortieColisItem([
                    "sortieColis" => $data->id,
                    "site" => $site[$i],
                    "scelle" => $scelle[$i],
                    "nbre_colis" => $nbre_colis[$i],
                    'colis' => $colis[$i],
                    'valeur_colis_xof_sortie' => $valeur_colis_xof[$i],
                    'device_etrangere_dollar_sortie' => $device_etrangere_dollar[$i],
                    'device_etrangere_euro_sortie' => $device_etrangere_euro[$i],
                    'pierre_precieuse_sortie' => $pierre_precieuse[$i],
                ]);
                $item->save();
            }
        }

        return redirect("caisse-sortie-colis-liste")->with('success', 'Enregistrement effectué!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $centres = Centre::all();
        $centres_regionaux = Centre_regional::all();
        $agents = DB::table('personnels')->where('fonction', 'like', '%convoyeur%')->get();
        $chefBords = DB::table('personnels')->where('fonction', 'like', '%convoyeur%')->get();
        $sites = Commercial_site::with("clients")->get();
        $items = CaisseSortieColisItem::with("sites")->where("sortieColis", $id)->get();
        $colis = CaisseSortieColis::with('sites')->find($id);
        $tournees = DepartTournee::with('agentDeGardes')->with('chefDeBords')->with('chauffeurs')->with('vehicules')->get();
        return view('/caisse/sortie-colis.edit', compact('colis', 'items', 'centres', 'centres_regionaux', 'agents', 'chefBords', 'sites', 'tournees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = CaisseSortieColis::find($id);
        $data->noTournee = $request->get("noTournee");
        $data->receveur = $request->get("receveur");
        //$data->date = $request->get("date");
        //$data->heure = $request->get("heure");
        //$data->centre = $request->get("centre");
        //$data->centre_regional = $request->get("centre_regional");
        //$data->agent = $request->get("agentDeGarde");
        //$data->chef = $request->get("chefDeBord");

        $data->save();

        $site = $request->get("site");
        $scelle = $request->get("scelle");
        $nbre_colis = $request->get("nbre_colis");

        $colis =  $request->get("colis");
        $valeur_colis_xof = $request->get("valeur_colis_xof");
        $device_etrangere_dollar = $request->get("device_etrangere_dollar");
        $device_etrangere_euro = $request->get("device_etrangere_dollar");
        $pierre_precieuse = $request->get("pierre_precieuse");
        $ids = $request->get("ids");

        if (!empty($site) && !empty($nbre_colis)) {
            for ($i = 0; $i < count($nbre_colis); $i++) {
                if (empty($ids[$i])) {
                    $item = new CaisseSortieColisItem([
                        "sortieColis" => $data->id,
                        "site" => $site[$i],
                        "scelle" => $scelle[$i],
                        "nbre_colis" => $nbre_colis[$i],
                        'colis' => $colis[$i],
                        'valeur_colis_xof_sortie' => $valeur_colis_xof[$i],
                        'device_etrangere_dollar_sortie' => $device_etrangere_dollar[$i],
                        'device_etrangere_euro_sortie' => $device_etrangere_euro[$i],
                        'pierre_precieuse_sortie' => $pierre_precieuse[$i],
                    ]);
                    $item->save();
                } else {
                    $item = CaisseSortieColisItem::find($ids[$i]);
                    $item->site = $site[$i];
                    $item->colis = $colis[$i];
                    $item->scelle = $scelle[$i];
                    $item->nbre_colis = $nbre_colis[$i];

                    $item->colis = $colis[$i];
                    $item->valeur_colis_xof_sortie = $valeur_colis_xof[$i];
                    $item->device_etrangere_dollar_sortie = $device_etrangere_dollar[$i];
                    $item->device_etrangere_euro_sortie = $device_etrangere_euro[$i];
                    $item->pierre_precieuse_sortie = $pierre_precieuse[$i];
                    $item->save();
                }


            }
        }


        return redirect("caisse-sortie-colis-liste")->with('success', 'Enregistrement effectué!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $coli = CaisseSortieColis::find($id);
        $coli->delete();
        $items = DB::table('caisse_sortie_colis_items')->where('sortieColis', $id)->get();
        foreach ($items as $item) {
            $i = CaisseSortieColisItem::find($item->id);
            $i->delete();
        }
        //return redirect('/caisse-sortie-colis-liste')->with('success', 'Service supprimé avec succès!');
        return \response()->json([
            "message" => "ok"
        ]);
    }

    public function destroyItem($id)
    {
        $coli = CaisseSortieColisItem::find($id);
        $coli->delete();
        return \response()->json([
            "message" => "ok"
        ]);
    }
}
