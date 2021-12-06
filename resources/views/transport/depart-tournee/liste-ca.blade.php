@extends('base')

@section('main')
    <div class="burval-container">
        <div><h2 class="heading">Liste chiffre d'affaire</h2></div>
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

        <div class="row">
            <div class="col">
                <h6 class="text-danger">Chiffre d'affaire : <span>{{$totalTournee}}</span></h6>
                <h6 class="text-danger">Nombre de passage : <span>{{count($sites)}}</span></h6>
            </div>
            <div class="col"></div>
        </div>
        <br>
        <form action="#" method="get">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="centre" class="col-5">Centre Régional</label>
                        <select name="centre" id="centre" class="form-control col">
                            <option>{{$centre}}</option>
                            @foreach ($centres as $centre)
                                <option value="{{$centre->centre}}">{{ $centre->centre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="centre_regional" class="col-5">Centre</label>
                        <select id="centre_regional" name="centre_regional" class="form-control col">
                            <option>{{$centre_regional}}</option>
                            @foreach ($centres_regionaux as $centre)
                                <option value="{{$centre->centre}}">{{ $centre->centre_regional }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="client" class="col-5">Clients</label>
                        <select id="client" name="client" class="form-control col">
                            <option>{{$client}}</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{ $client->client_nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="site" class="col-5">Site</label>
                        <select id="site" name="site" class="form-control col">
                            <option>{{$site}}</option>
                            @foreach ($sites_com as $site)
                                <option value="{{$site->id}}">{{ $site->site }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-5">Date début</label>
                        <input type="date" name="debut" class="form-control col-7" value="{{$debut}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-5">Date fin</label>
                        <input type="date" name="fin" class="form-control col-sm-7" value="{{$fin}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="tdf" class="col-5">TDF</label>
                        <select name="tdf" id="tdf" class="form-control col-sm-7">
                            <option></option>
                            <option value="oo_vb_extamuros_bitume">VB extramuros bitume</option>
                            <option value="oo_vb_extramuros_piste">VB extramuros piste</option>
                            <option value="oo_vl_extramuros_bitume">VL extramuros bitume</option>
                            <option value="oo_vl_extramuros_piste">VL extramuros piste</option>
                            <option value="oo_vb_intramuros">VB</option>
                            <option value="oo_vl_intramuros">VL</option>
                            <option value="oo_ass_appro">Assistance appro DAB</option>
                            <option value="oo_dnf">Dépôt non facturé</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="caisse" class="col-5">Caisse</label>
                        <select name="caisse" id="caisse" class="form-control col-sm-7">
                            <option></option>
                            <option value="oo_mad">MAD</option>
                            <option value="oo_collecte">Collecte</option>
                            <option value="oo_cctv">CCTV</option>
                            <option value="oo_collecte_caisse">Collecte Caisse</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col text-right">
                    <button class="btn btn-info btn-sm" type="reset">Effacer</button> <button class="btn btn-primary btn-sm" type="submit">Rechercher</button>
                </div>
            </div>
        </form>

        <br>
        <table id="table" class="table table-bordered table-hover" style="width: 100%">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Centre regional</th>
                <th scope="col">Centre</th>
                <th scope="col">No. Tournée</th>
                <th scope="col">Date</th>
                <th scope="col">Client</th>
                <th scope="col">Site</th>
                <th scope="col">Op</th>
                <th scope="col">TDF</th>
                <th scope="col">Montant TDF</th>
                <th scope="col">Caisse</th>
                <th scope="col">Montant Caisse</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sites as $site)
                <tr>
                    <td>{{$site->id}}</td>
                    <td>{{$site->tournees->centre ?? ""}}</td>
                    <td>{{$site->tournees->centre_regional ?? ""}}</td>
                    <td>{{$site->tournees->numeroTournee}}</td>
                    <td>{{$site->tournees->date}}</td>
                    <td>{{$site->sites->clients->client_nom ?? ""}}</td>
                    <td>{{$site->sites->site ?? ""}}</td>
                    <td>{{$site->type ?? ""}}</td>
                    <td>
                        @switch($site->tdf)
                            @case("oo_vb_extamuros_bitume")
                            VB extramuros bitume
                            @break
                            @case("oo_vb_extramuros_piste")
                            VB extramuros piste
                            @break
                            @case("oo_vl_extramuros_bitume")
                            VL extramuros bitume
                            @break
                            @case("oo_vl_extramuros_piste")
                            VL extramuros piste
                            @break
                            @case("oo_vb_intramuros")
                            VB
                            @break
                            @case("oo_vl_intramuros")
                            VL
                            @break
                            @case("oo_ass_appro")
                            Assistance appro DAB
                            @break
                            @case("oo_dnf")
                            Dépôt non facturé
                            @break
                            @default
                            ..
                        @endswitch
                    </td>
                    <td>{{$site->sites["$site->tdf"]}}</td>
                    <td>@switch($site->caisse)
                            @case("oo_mad")
                            MAD
                            @break
                            @case("oo_collecte")
                            Collecte
                            @break
                            @case("oo_cctv")
                            CCTV
                            @break
                            @case("oo_collecte_caisse")
                            Collecte caisse
                            @break
                            @default
                            @break
                        @endswitch</td>
                    <td>{{$site->sites["$site->caisse"]}}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "French.json"
                }
            });

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
    </script>
@endsection
