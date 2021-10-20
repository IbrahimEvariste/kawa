@extends('base')

@section('main')
    <div class="burval-container">
        <div><h2 class="heading">Régulation départ tournée</h2></div>
        <br/>
        <br/>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br/>
        @endif

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif


        <form action="{{ route('regulation-depart-tournee.update', $tournee->id) }}" method="post">
            @csrf
            @method("PATCH")
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4">Date départ</label>
                            <input type="text" name="date" id="date" value="{{$tournee->date}}" class="form-control col-sm-8" readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="heure" class="col-sm-4">Heure départ</label>
                            <input type="text" name="heure" id="heure" value="{{$tournee->heure}}" class="form-control col-sm-8" readonly/>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group row">
                            <label for="no_tournee" class="col-sm-4">N°Tournée</label>
                            <input type="text" class="form-control col-sm-8" name="noTournee" id="noTournee" value="{{$tournee->numeroTournee}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4">Véhicule</label>
                            <input class="form-control col-sm-8" name="vehicule" id="vehicule" value="{{$tournee->vehicules->immatriculation?? "Donnée indisponible"}}" readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4">Chauffeur:</label>
                            <input class="form-control col-sm-8" name="chauffeur" id="chauffeur" value="{{$tournee->chauffeurs->nomPrenoms ?? "Données indisponible"}}" readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4">Agent garde</label>
                            <input class="form-control col-sm-8" name="agentDeGarde" id="agentDeGarde" value="{{$tournee->agentDeGarde->nomPrenoms ?? "Données indisponible"}}"  readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4">Chef de bord</label>
                            <input class="form-control col-sm-8" name="chefDeBord" id="chefDeBord" value="{{$tournee->chefDeBords->nomPrenoms ?? "Données indisponible"}}" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="centre" class="col-sm-4">Centre régional</label>
                            <input name="centre" id="centre" class="form-control col-sm-8" value="{{$tournee->centre}}" readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="centre_regional" class="col-sm-4">Centre</label>
                            <input id="centre_regional" name="centre_regional" class="form-control col-sm-8" value="{{$tournee->centre}}" readonly/>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
            </div>
            <div class="container">
                <br>
                <br>
                <table class="table table-bordered" id="tableSite">
                    <thead>
                    <tr>
                        <th>Site</th>
                        <th>Client</th>
                        <th>Colis</th>
                        <th>Valeur colis (XOF)</th>
                        <th>Devise étrangère (Dollar)</th>
                        <th>Devise étrangère (Euro)</th>
                        <th>Pierre précieuse</th>
                        <th>Numéro</th>
                        <th>Autre colis</th>
                        <th>Valeur autre colis</th>
                        <th>Numéros (autre colis)</th>
                        <th>Nombre total (colis + autre colis)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sitesItems as $site)
                        <tr>
                            <td>
                                <select name="site[]" class="form-control">
                                    <option value="{{$site->site}}">{{$site->sites->site}}</option>
                                    @foreach($sites as $s)
                                        <option value="{{$s->id}}">{{$s->site}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="site_id[]" value="{{$site->id}}">
                            </td>
                            <td><input type="text" name="client[]" value="{{$site->client}}" class="form-control"></td>
                            <td><select name="colis[]" class="form-control">
                                    <option>{{$site->colis}}</option>
                                    <option>Sac jute</option>
                                    <option>Keep safe</option>
                                    <option>Caisse</option>
                                    <option>Conteneur</option>
                                </select></td>
                            <td><input type="number" name="valeur_colis_xof[]" value="{{$site->valeur_colis_xof}}" class="form-control"></td>
                            <td><input type="number" name="device_etrangere_dollar[]" value="{{$site->device_etrangere_dollar}}" class="form-control"></td>
                            <td><input type="number" name="device_etrangere_euro[]" value="{{$site->device_etrangere_euro}}" class="form-control"></td>
                            <td><input type="number" name="pierre_precieuse[]" value="{{$site->pierre_precieuse}}" class="form-control"></td>
                            <td><input type="text" name="numero[]" value="{{$site->numero}}" class="form-control"></td>
                            <td><input type="text" name="autre[]" value="{{$site->autre ??  "RAS"}}" class="form-control"></td>
                            <td><input type="number" min="0" name="valeur_autre[]" value="{{$site->valeur_autre}}" class="form-control"></td>
                            <td><input type="text" name="numero_scelle[]" value="{{$site->numero_scelle}}" class="form-control"></td>
                            <td><input type="number" name="nbre_colis[]" value="{{$site->nbre_colis}}" class="form-control"></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" style="vertical-align: center;">TOTAL</td>
                        <td><input type="number" name="totalValeurColis" id="totalValeurColis" value="{{$sitesItems->sum("valeur_colis")}}" class="form-control border-0"></td>
                        <td></td>
                        <td><input type="number" name="totalColis" id="totalColis" value="{{$sitesItems->sum("nbre_colis")}}"  class="form-control border-0"></td>
                    </tr>
                    </tfoot>
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="/regulation-depart-tournee-liste" class="btn btn-info" style="margin-left: 20px">Ouvrir la liste</a>
            </div>
        </form>

    </div>
    <script>
        let tournees = {!! json_encode($tournees) !!};
        let sites = {!! json_encode($sites) !!};
        $(document).ready(function () {
            $("#noTournee").on("change", function () {
                $("#vehicule").val("");
                $("#chauffeur").val("");
                $("#chefDeBord").val("");
                $("#agentDeGarde").val("");
                $("#centre_regional option").remove();

                const tournee = tournees.find(t => t.id === parseInt(this.value ?? 0));
                if (tournee) {
                    $("#vehicule").val(tournee.vehicules.immatriculation);
                    $("#chauffeur").val(tournee.chauffeurs.nomPrenoms);
                    $("#chefDeBord").val(tournee.chef_de_bords.nomPrenoms);
                    $("#agentDeGarde").val(tournee.agent_de_gardes.nomPrenoms);
                    $("#centre").val(tournee.centre);
                    $("#centre_regional").val(tournee.centre_regional);

                    const commerciaux = sites.filter(site => {
                        return site.centre === tournee.centre;
                    });
                    console.log(commerciaux);
                    commerciaux.map(({id, site, clients}) => {
                        $('#asSite').append($('<option>', {
                            value: id,
                            text: `${site} (${clients.client_nom})`
                        }));
                    })
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $("input[name='montant[]']").on("change", function () {
                let montantTotal = 0;
                $.each($("input[name='montant[]']"), function (i) {
                    const montant = $("input[name='montant[]'").get(i).value;
                    montantTotal += parseFloat(montant) ?? 0;
                });
                $("#totalMontant").val(montantTotal);

            });
            $("input[name='nbre_colis[]']").on("change", function () {
                let totalColis = 0;
                $.each($("input[name='nbre_colis[]']"), function (i) {
                    const nbre = $("input[name='nbre_colis[]'").get(i).value;
                    totalColis += parseFloat(nbre) ?? 0;
                });
                $("#totalColis").val(totalColis);
            });
            $("input[name='valeur_colis[]']").on("change", function () {
                let totalValeurColis = 0;
                $.each($("input[name='valeur_colis[]']"), function (i) {
                    const nbre = $("input[name='valeur_colis[]'").get(i).value;
                    totalValeurColis += parseFloat(nbre) ?? 0;
                });
                $("#totalValeurColis").val(totalValeurColis);
            });
            $("input[name='valeur_autre[]']").on("change", function () {
                let totalValeurAutre = 0;
                $.each($("input[name='valeur_autre[]']"), function (i) {
                    const nbre = $("input[name='valeur_autre[]'").get(i).value;
                    totalValeurAutre += parseFloat(nbre) ?? 0;
                });
                $("#totalValeurAutre").val(totalValeurAutre);
            });

        })
    </script>
@endsection
