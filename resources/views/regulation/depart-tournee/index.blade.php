@extends('base')

@section('main')
    <div class="container-fluid">
        <br>
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


        <form action="{{ route('regulation-depart-tournee.store') }}" method="post">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4">Date départ</label>
                            <input type="text" name="date" id="date" value="{{$date}}" class="form-control col-sm-8"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="heure" class="col-sm-4">Heure départ</label>
                            <input type="text" name="heure" id="heure" value="{{$heure}}"
                                   class="form-control col-sm-8"/>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group row">
                            <label for="no_tournee" class="col-sm-4">N°Tournée</label>
                            <select class="form-control col-sm-8" name="noTournee" id="noTournee">
                                <option></option>
                                @foreach($tournees as $tournee)
                                    <option value="{{$tournee->id}}">{{$tournee->numeroTournee}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4">Véhicule</label>
                            <input class="form-control col-sm-8" name="vehicule" id="vehicule" readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4">Chauffeur:</label>
                            <input class="form-control col-sm-8" name="chauffeur" id="chauffeur" readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4">Agent garde</label>
                            <input class="form-control col-sm-8" name="agentDeGarde" id="agentDeGarde" readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4">Chef de bord</label>
                            <input class="form-control col-sm-8" name="chefDeBord" id="chefDeBord" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="centre" class="col-sm-4">Centre</label>
                            <input name="centre" id="centre" class="form-control col-sm-8" readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="centre_regional" class="col-sm-4">Centre régional</label>
                            <input id="centre_regional" name="centre_regional" class="form-control col-sm-8" readonly/>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
            </div>
            <div class="container-fluid">
                <br>
                <br>
                <table class="table table-bordered" id="tableSite">
                    <thead>
                    <tr>
                        <th>Site</th>
                        <th>Client</th>
                        <th>Colis</th>
                        <th>Valeur colis (XOF)</th>
                        <th>Valeur devise étrangère (Dollar)</th>
                        <th>Valeur devise étrangère (Euro)</th>
                        <th>Valeur pierre précieuse</th>
                        <th>Numéro</th>
                        <th>Nombre total de colis</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--<tr>
                        <td>
                            <select name="site[]" class="form-control">
                                <option></option>
                                @foreach($sites as $site)
                                    <option value="{{$site->id}}">{{$site->site}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="client[]" class="form-control"></td>
                        <td><input type="text" name="autre[]" class="form-control"></td>
                        <td><select name="nature[]" class="form-control">
                                <option>envoi</option>
                                <option>tri</option>
                                <option>transite</option>
                                <option>approvisionnement</option>
                            </select></td>
                        <td><input type="text" name="numero_scelle[]" class="form-control"></td>
                        <td><input type="number" name="nbre_colis[]" class="form-control"></td>
                        <td><input type="text" name="montant[]" class="form-control"></td>
                    </tr>--}}
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" style="vertical-align: center;">TOTAL</td>
                        <td><input type="number" name="totalValeurXOF" id="totalValeurXOF" class="form-control" readonly></td>
                        <td><input type="number" name="totalValeurDollar" id="totalValeurDollar" class="form-control" readonly>
                        </td>
                        <td><input type="number" name="totalValeurEuro" id="totalValeurEuro" class="form-control" readonly></td>
                        <td><input type="number" name="totalValeurPierre" id="totalValeurPierre" class="form-control" readonly></td>
                        <td></td>
                        <td><input type="number" name="totalColis" id="totalColis" class="form-control" readonly></td>
                    </tr>
                    </tfoot>
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
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
                $("#totalColis").val("");
                $("#totalMontant").val("");
                $("#centre_regional option").remove();

                const tournee = tournees.find(t => t.id === parseInt(this.value ?? 0));
                if (tournee) {
                    $("#vehicule").val(tournee.vehicules?.immatriculation ?? '');
                    $("#chauffeur").val(tournee.chauffeurs?.nomPrenoms ?? '');
                    $("#chefDeBord").val(tournee.chef_de_bords?.nomPrenoms ?? '');
                    $("#agentDeGarde").val(tournee.agent_de_gardes?.nomPrenoms ?? '');
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
                const departSites = sites.filter(v => {
                    return parseInt(v.idTourneeDepart) === parseInt(this.value);
                });
                if (departSites) populateSites(departSites);
                changeColis();
            });
        });

        function populateSites(sites) {
            // console.log(sites);
            $("#tableSite > tbody").html("");
            sites.map(s => {
                let HTML_NODE = `<tr>
                        <td>
                                <input type="text" class="form-control" name="site[]" value="${s.sites.site}" readonly/>
                                <input type="hidden" class="form-control" name="site_id[]" value="${s.id}"/>
                        </td>
                        <td><input type="text" name="client[]" class="form-control" value="${s.sites.clients.client_nom}" readonly></td>
                        <td><select name="colis[]" class="form-control">
                                <option>${s.colis ?? 'RAS'}</option>
                                <option value="RAS">RAS</option>
                                <option>Sac jute</option>
                                <option>Keep safe</option>
                                <option>Caisse</option>
                                <option>Conteneur</option>
                                </select></td>
                        <td><input type="text" name="valeur_colis_xof[]" value="${s.valeur_colis_xof ?? 0}" class="form-control"></td>
                        <td><input type="text" min="0" name="device_etrangere_dollar[]" value="${s.device_etrangere_dollar ?? 0}" class="form-control"></td>
                        <td><input type="text" min="0" name="device_etrangere_euro[]" value="${s.device_etrangere_euro ?? 0}" class="form-control"></td>
                        <td><input type="text" min="0" name="pierre_precieuse[]" value="${s.pierre_precieuse ?? 0}" class="form-control"></td>
                        <td><textarea name="numero[]" class="form-control">${s.numero ?? ''}</textarea></td>
                        <td><input type="number" name="nbre_colis[]" value="${s?.nbre_colis ?? 0}" class="form-control"></td>
                </tr>`;

                $("#tableSite").append(HTML_NODE);

                // Calcul du montant total
                let montantTotal = 0;
                $.each($("input[name='montant[]']"), function (i) {
                    const montant = $("input[name='montant[]'").get(i).value;
                    montantTotal += parseFloat(montant) ?? 0;
                });
                $("#totalMontant").val(montantTotal);

                // Calcul du nombre de colis total
                let totalColis = 0;
                $.each($("input[name='nbre_colis[]']"), function (i) {
                    const nbre = $("input[name='nbre_colis[]'").get(i).value;
                    totalColis += parseFloat(nbre) ?? 0;
                });
                $("#totalColis").val(totalColis);

                // Calcul valeur colis
                let totalValeurColis = 0;
                $.each($("input[name='valeur_colis[]']"), function (i) {
                    const nbre = $("input[name='valeur_colis[]'").get(i).value;
                    totalValeurColis += parseFloat(nbre) ?? 0;
                });
                $("#totalValeurColis").val(totalValeurColis);

            });

            changeXOF();
            changeDollar();
            changeEuro();
            changePierre();
            changeNombreColis();
        }
    </script>
    <script>
        $(document).on('DOMNodeInserted', function () {
            $("select[name='site[]']").on("change", function () {
                let index = 0;
                const thisSite = this;
                $.each($("select[name='site[]']"), function (i) {
                    const site = $("select[name='site[]']").get(i);
                    if (thisSite === site) {
                        index = i;
                    }
                });
                const site = sites.find(s => s.id === parseInt(this.value));
                if (site) {
                    console.log(site);
                    $("input[name='client[]']").eq(index).val(site.clients.client_nom);
                } else {
                    console.log("Site non trouvé :-(");
                }
            });
        });
    </script>
    <script>
        $(document).on('DOMNodeInserted', function () {
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
            $("input[name='valeur_colis_xof[]']").on("change", changeXOF);
            $("input[name='device_etrangere_dollar[]']").on("change", changeDollar);
            $("input[name='device_etrangere_euro[]']").on("change", changeEuro);
            $("input[name='pierre_precieuse[]']").on("change", changePierre);
            $("select[name='colis[]']").on("change", changeColis);
        });
    </script>
    <script>
        function separateNumbers(e){
            try {
                let str = e.value?.replace(/\s/g, '');
                const donnee = parseFloat(str);
                $(e).val(Number(donnee).toLocaleString());
            } catch (e) {
                console.log(e)
            }
        }
        function changeXOF() {
            separateNumbers(this);
            let total = 0;
            $.each($("input[name='valeur_colis_xof[]']"), function (i) {
                const nbre = $("input[name='valeur_colis_xof[]'").get(i).value;
                total += parseFloat(nbre) ?? 0;
            });
            $("#totalValeurXOF").val(total);
        }
        function changeDollar() {
            separateNumbers(this);
            let total = 0;
            $.each($("input[name='device_etrangere_dollar[]']"), function (i) {
                const nbre = $("input[name='device_etrangere_dollar[]'").get(i).value;
                total += parseFloat(nbre) ?? 0;
            });
            $("#totalValeurDollar").val(total);
        }
        function changeEuro() {
            separateNumbers(this);
            let total = 0;
            $.each($("input[name='device_etrangere_euro[]']"), function (i) {
                const nbre = $("input[name='device_etrangere_euro[]'").get(i).value;
                total += parseFloat(nbre) ?? 0;
            });
            $("#totalValeurEuro").val(total);
        }
        function changePierre() {
            separateNumbers(this);
            let total = 0;
            $.each($("input[name='pierre_precieuse[]']"), function (i) {
                const nbre = $("input[name='pierre_precieuse[]'").get(i).value;
                total += parseFloat(nbre) ?? 0;
            });
            $("#totalValeurPierre").val(total);
        }
        function changeNombreColis() {
            let totalColis = 0;
            $.each($("input[name='nbre_colis[]']"), function (i) {
                const nbre = $("input[name='nbre_colis[]'").get(i).value;
                totalColis += parseFloat(nbre) ?? 0;
            });
            $("#totalColis").val(totalColis);
        }
        function changeColis() {
            separateNumbers(this);
            let index = 0;
            const thisColisInput = this;
            // Trouver l'index du champs actuel
            $.each($("select[name='colis[]']"), function (i) {
                const colis = $("select[name='colis[]']").get(i);
                if (thisColisInput === colis) {
                    index = i;
                }
                if (colis.value === "RAS" ) {
                    $("input[name='valeur_colis_xof[]']").eq(i).prop('readonly', "readonly");
                    $("input[name='device_etrangere_dollar[]']").eq(i).prop('readonly', "readonly");
                    $("input[name='device_etrangere_euro[]']").eq(i).prop('readonly', "readonly");
                    $("input[name='pierre_precieuse[]']").eq(i).prop('readonly', "readonly");
                    $("textarea[name='numero[]']").eq(i).prop('readonly', "readonly");
                    $("input[name='nbre_colis[]']").eq(i).prop('readonly', "readonly");
                    $("select[name='nature[]']").eq(i).prop('readonly', "readonly");
                } else {
                    $("input[name='valeur_colis_xof[]']").eq(i).prop('readonly', false);
                    $("input[name='device_etrangere_dollar[]']").eq(i).prop('readonly', false);
                    $("input[name='device_etrangere_euro[]']").eq(i).prop('readonly', false);
                    $("input[name='pierre_precieuse[]']").eq(i).prop('readonly', false);
                    $("textarea[name='numero[]']").eq(i).prop('readonly', false);
                    $("input[name='nbre_colis[]']").eq(i).prop('readonly', false);
                    $("select[name='nature[]']").eq(i).prop('readonly', false);
                }
            });

        }
    </script>
@endsection
