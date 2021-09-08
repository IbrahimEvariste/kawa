@extends('base')

@section('main')
    <div class="burval-container">
        <div><h2 class="heading">Départ tournée</h2></div>
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

        <form method="post" action="{{ route('depart-tournee.update', $tournee->id) }}">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>N°Tournée:</label>
                        <input type="text" class="form-control" name="numeroTournee" value="{{$tournee->numeroTournee}}"
                               readonly/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{$tournee->date}}"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Véhicule</label>
                        <select class="form-control" name="idVehicule" id="vehicule">
                            <option
                                value="{{$tournee->idVehicule}}">{{$tournee->vehicules->immatriculation ?? 'Vehicule inexistant' . $tournee->idVehicule}}</option>
                            @foreach($vehicules as $vehicule)
                                <option value="{{$vehicule->id}}">{{$vehicule->immatriculation}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Kilométrage départ</label>
                        <input type="number" class="form-control" name="kmDepart" value="{{$tournee->kmDepart}}"
                               id="kmDepart" min="0"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Chauffeur</label>
                        <select class="form-control" name="chauffeur" id="chauffeur">
                            <option
                                value="{{$tournee->chauffeur}}">{{$tournee->chauffeurs->nomPrenoms ?? 'Utilisateur inexistant ' . $tournee->chauffeur}}</option>
                            @foreach($chauffeurs as $chauffeur)
                                <option value="{{$chauffeur->id}}">{{$chauffeur->nomPrenoms}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Agent de garde</label>
                        <select class="form-control" name="agentDeGarde">
                            <option
                                value="{{$tournee->agentDeGarde}}">{{$tournee->agentDeGardes->nomPrenoms ?? 'Utilisateur inexistant ' . $tournee->agentDeGarde}}</option>
                            @foreach($agents as $agent)
                                <option value="{{$agent->id}}">{{$agent->nomPrenoms}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Chef de bord</label>
                        <select class="form-control" name="chefDeBord">
                            <option
                                value="{{$tournee->chefDeBord}}">{{$tournee->chefDeBords->nomPrenoms ?? 'Utilisateur inexistant ' . $tournee->chefDeBord}}</option>
                            @foreach($chefBords as $chef)
                                <option value="{{$chef->id}}">{{$chef->nomPrenoms}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Coût tournée</label>
                        <input type="number" class="form-control" min="0" name="coutTournee"
                               value="{{$tournee->coutTournee}}" id="coutTournee"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Heure départ</label>
                        <input type="time" class="form-control" name="heureDepart" value="{{$tournee->heureDepart}}"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="centre">Centre</label>
                        <select name="centre" id="centre" class="form-control" required>
                            <option>{{$tournee->centre}}</option>
                            @foreach ($centres as $centre)
                                <option value="{{$centre->centre}}">Centre de {{ $centre->centre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="centre_regional">Centre régional</label>
                        <select id="centre_regional" name="centre_regional" class="form-control" required>
                            <option>{{$tournee->centre_regional}}</option>
                        </select>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <br/>


            <button type="button" class="btn btn-sm btn-primary" id="add">+</button>
            <br>
            <div id="data">
                @foreach($sitesTournees as $site)
                    <input type="hidden" name="site_id[]" value="{{$site->id}}">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Site</label>
                                        <select class="form-control" name="site_edit[]" id="site{{$site->id}}">
                                            <option
                                                value="{{$site->site}}">{{$site->sites->site ?? $site->site}}</option>
                                            @foreach ($commercial_sites as $commercial)
                                                <option value="{{$commercial->id}}">{{$commercial->site}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>heure</label>
                                        <input type="time" class="form-control" name="heure_edit[]"
                                               value="{{$site->heure}}"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>TDF</label>
                                        <select class="form-control" name="tdf_edit[]">
                                            <option value="{{$site->tdf}}">{{$site->sites["$site->tdf"] ?? 0}}</option>
                                            <option value="oo_vb_extamuros_bitume">VB extramuros bitume</option>
                                            <option value="oo_vb_extramuros_piste">VB extramuros piste</option>
                                            <option value="oo_vl_extramuros_bitume">VL extramuros bitume</option>
                                            <option value="oo_vl_extramuros_piste">VL extramuros piste</option>
                                            <option value="oo_vb_intramuros">VB</option>
                                            <option value="oo_vl_intramuros">VL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Caisse</label>
                                        <select class="form-control" name="caisse_edit[]">
                                            <option
                                                value="{{$site->caisse}}">{{$site->sites["$site->caisse"] ?? $site->caisse}}</option>
                                            <option value="oo_mad">MAD</option>
                                            <option value="oo_collecte">Collecte</option>
                                            <option value="oo_cctv">CCTV</option>
                                            <option value="oo_collecte_caisse">Collecte Caisse</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="col">
                        <br/>
                        <button class="btn btn-primary">Enregistrer</button>
                        <button class="btn btn-danger" type="button" onclick="window.history.back()">Annuler</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <script>
        $(document).ready(function () {
            let centres = {!! json_encode($centres) !!};
            let centres_regionaux = {!! json_encode($centres_regionaux) !!};

            $("#centre").on("change", function () {
                $("#centre_regional option").remove();
                const centre = centres.find(c => c.centre === this.value);
                const regions = centres_regionaux.filter(region => {
                    return region.id_centre === centre.id;
                });
                regions.map(({centre_regional}) => {
                    $('#centre_regional').append($('<option>', {
                        value: centre_regional,
                        text: centre_regional
                    }));
                })
            });
        });
        /*let vehicules = {};
        let sites = {};

        let cout = 0;
        let site = null;

        $("#vehicule").on("change", function () {
            $("#chauffeur option").remove();
            const vehicule = vehicules.find(v => v.id === parseInt(this.value));
            if (vehicule) {
                $('#chauffeur').append($('<option>', {
                    value: vehicule.chauffeur_titulaire.id,
                    text: vehicule.chauffeur_titulaire.nomPrenoms
                }));
                $('#chauffeur').append($('<option>', {
                    value: vehicule.chauffeur_suppleant.id,
                    text: vehicule.chauffeur_suppleant.nomPrenoms
                }));
            }
        });*/

        /*$("select[name='type[]']").on("change", function() {
            cout = 0;
            let i = -1;
            $.each( $( "select[name='type[]']" ), function() {
                i++;
                const type = $("select[name='type[]']").get(i);
                const site = $("select[name='site[]']").get(i);
                if (type.value && site.value) {

                    const site1 = sites.find(s => s.id === parseInt(site.value));
                    if (site1) {
                        const prix = site1[type.value];
                        console.log(prix);
                        if (!isNaN(prix)) cout += parseInt(prix);
                        $("#coutTournee").val(cout);
                    }
                }

            });

        });

        $("#kmDepart").on("change", function () {
            $("#coutTournee").val(cout * parseInt(this.value));
        });

        function populateSites(sites) {
            // console.log(sites);
            $(".sitesListes div").remove();
            sites.map(s => {

                let HTML_NODE = `<div class="col-4">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Site</label>
                                <input type="text" class="form-control" name="site[]" value="${s.sites.site}" readonly/>
                                <input type="hidden" class="form-control" name="site_id[]" value="${s.id}"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Bordereau</label>
                                <input type="text" class="form-control" name="bordereau[]" value="${s?.bordereau}"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Montant</label>
                                <input type="text" class="form-control" min="0" name="montant[]" value="${s?.montant}"/>
                            </div>
                        </div>
                    </div>
                </div>`;

                $(".sitesListes").append(HTML_NODE);
            });
        }*/

        $(document).ready(function () {
            let index = 0;
            $("#add").on("click", function () {
                index++;
                $("#data").append(' <div class="row">\n' +
                    '                        <div class="col">\n' +
                    '                            <div class="row">\n' +
                    '                                <div class="col">\n' +
                    '                                    <div class="form-group">\n' +
                    '                                        <label>Site </label>\n' +
                    '                                        <select class="form-control" name="site[]" id="site '+index+'">\n' +
                    '                                            <option></option>\n' +
                    '                                            @foreach ($commercial_sites as $site)\n' +
                    '                                                <option value="{{$site->id}}">{{$site->site}}</option>\n' +
                    '                                            @endforeach\n' +
                    '                                        </select>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                                <div class="col">\n' +
                    '                                    <div class="form-group">\n' +
                    '                                        <label>heure</label>\n' +
                    '                                        <input type="time" class="form-control" name="heure[]"/>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                                <div class="col">\n' +
                    '                                    <div class="form-group">\n' +
                    '                                        <label>TDF</label>\n' +
                    '                                        <select class="form-control" name="tdf[]" disabled>\n' +
                    '                                            <option></option>\n' +
                    '                                            <option value="oo_vb_extamuros_bitume">VB extramuros bitume</option>\n' +
                    '                                            <option value="oo_vb_extramuros_piste">VB extramuros piste</option>\n' +
                    '                                            <option value="oo_vl_extramuros_bitume">VL extramuros bitume</option>\n' +
                    '                                            <option value="oo_vl_extramuros_piste">VL extramuros piste</option>\n' +
                    '                                            <option value="oo_vb_intramuros">VB</option>\n' +
                    '                                            <option value="oo_vl_intramuros">VL</option>\n' +
                    '                                        </select>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                                <div class="col">\n' +
                    '                                    <div class="form-group">\n' +
                    '                                        <label>Caisse</label>\n' +
                    '                                        <select class="form-control" name="caisse[]" disabled>\n' +
                    '                                            <option></option>\n' +
                    '                                            <option value="oo_mad">MAD</option>\n' +
                    '                                            <option value="oo_collecte">Collecte</option>\n' +
                    '                                            <option value="oo_cctv">CCTV</option>\n' +
                    '                                            <option value="oo_collecte_caisse">Collecte Caisse</option>\n' +
                    '                                        </select>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                            </div>\n' +
                    '                        </div>\n' +
                    '                    </div>');
            });
        });
    </script>

    <script>

        let sites = {!! json_encode($commercial_sites) !!};
        $(document).on('DOMNodeInserted', function () {

            // Activer les champs TDF et Caisse
            $("select[name='site[]']").on("change", function () {
                let index = 0;
                const thisSite = this;
                // Trouver l'index du champs actuel
                $.each($("select[name='site[]']"), function (i) {
                    const site = $("select[name='site[]']").get(i);
                    if (thisSite === site) {
                        index = i;
                    }
                });
                const site = sites.find(s => s.id === parseInt(this.value));
                if (site) {
                    $("select[name='tdf[]']").eq(index).prop('disabled', false);
                    $("select[name='caisse[]']").eq(index).prop('disabled', false);
                } else {
                    console.log("Site non trouvé :-(");
                }
            });

            // Calculer count total à partir de TDF
            $("select[name='tdf[]']").on("change", function () {
                let coutTournee = 0;
                const thisTDF = this;
                // Trouver l'index du champs actuel
                $.each($("select[name='tdf[]']"), function (i) {
                    const tdf = $("select[name='tdf[]']").get(i);
                    if (thisTDF === tdf) {
                        index = i;
                    }
                    const siteInput = $("select[name='site[]']").get(i);
                    const site = sites.find(s => s.id === parseInt(siteInput.value));
                    const caisseInput = $("select[name='caisse[]']").get(i);
                    if (site) {
                        const montantTDF = site[this.value] ?? 0;
                        const montantCaisse = site[caisseInput.value] ?? 0;
                        let cout = coutTournee += (parseFloat(montantTDF) ?? 0) + (parseFloat(montantCaisse) ?? 0);
                        $("#coutTournee").val(cout);
                    } else {
                        console.log("Site non trouvé :-(");
                    }
                });

            });

            // Calculer count total à partir de Caisse
            $("select[name='caisse[]']").on("change", function () {
                let coutTournee = 0;
                const thisTDF = this;
                // Trouver l'index du champs actuel
                $.each($("select[name='caisse[]']"), function (i) {
                    const tdf = $("select[name='caisse[]']").get(i);
                    if (thisTDF === tdf) {
                        index = i;
                    }
                    const siteInput = $("select[name='site[]']").get(i);
                    const site = sites.find(s => s.id === parseInt(siteInput.value));
                    const tdfInput = $("select[name='tdf[]']").get(i);
                    if (site) {
                        const montantCaisse = site[this.value] ?? 0;
                        const montantTDF = site[tdfInput.value] ?? 0;
                        let cout = coutTournee += (parseFloat(montantTDF) ?? 0) + (parseFloat(montantCaisse) ?? 0);
                        $("#coutTournee").val(cout);
                    } else {
                        console.log("Site non trouvé :-(");
                    }
                });

            });
        });
    </script>
@endsection
