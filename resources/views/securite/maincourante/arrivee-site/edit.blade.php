@extends("base")

@section("main")
    <div class="container">
        <br>
        <h2 class="heading">Arrivée site</h2>
        <a href="/maincourante-arriveesiteliste">Liste arrivée site</a>
        <br>
        <div class="container-fluid">
            <form method="post" action="/maincourante-arriveesiteliste/{{$site->id}}" novalidate>
                <input type="hidden" name="maincourante" value="arriveeSite"/>
                @method('PATCH')
                @csrf

                <br/>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group row">
                            <label class="col-sm-4">SITE</label>
                            <select type="text" name="asSite" id="asSite" class="form-control col-sm-8">
                                <option value="{{$site->site}}">{{$site->sites->site ?? "Site inexistant"}}</option>
                                @foreach($sites as $s)
                                    <option value="{{$s->id}}">{{$s->site}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="heure_depart" class="col-sm-4">Type opération</label>
                            <select name="asTypeOperation" class="form-control col-sm-8">
                                <option>{{$site->operation}}</option>
                                <option>Enlèvement</option>
                                <option>Dépot</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="asDateArrivee" class="col-sm-4">Date arrivée sur site</label>
                            <input type="date" name="asDateArrivee" value="{{$site->dateArrivee}}"
                                   class="form-control col-sm-8"/>
                        </div>
                        <div class="form-group row">
                            <label for="asDateArrivee" class="col-sm-4">Heure arrivée sur site</label>
                            <input type="time" name="asHeureArrivee" value="{{$site->heureArrivee}}"
                                   class="form-control col-sm-8"/>
                        </div>
                        <div class="form-group row">
                            <label for="asDebutOpération" class="col-sm-4">Heure début opération</label>
                            <input type="time" name="asDebutOperation" id="asDebutOperation"
                                   class="form-control col-sm-8" value="{{$site->debutOperation}}"/>
                        </div>
                        <div class="form-group row">
                            <label for="asFinOperation" class="col-sm-4">Heure fin opération</label>
                            <input type="time" name="asFinOperation" id="asFinOperation"
                                   class="form-control col-sm-8" value="{{$site->finOperation}}"/>
                        </div>
                        <div class="form-group row">
                            <label for="asTempsOperation" class="col-sm-4">Temps opération (mn)</label>
                            <input type="number" name="asTempsOperation" id="asTempsOperation"
                                   class="form-control col-sm-8" value="{{$site->tempsOperation}}" readonly/>
                        </div>
                        <div class="form-group row">
                            <label for="asNbColis" class="col-sm-4">Nombre de colis récupérés</label>
                            <input type="number" name="asNbColis" id="asNbColis" value="{{$site->nombre_colis}}"
                                   class="form-control col-sm-8"/>
                        </div>

                    </div>
                    <div class="col">

                        <br>
                        <button type="button" id="arriveeSiteColisButton" class="btn btn-sm btn-dark">Ajouter
                        </button>
                        <br>
                        <br>
                        <table class="table table-bordered" id="tableASColis">
                            <thead>
                            <tr>
                                <th>Colis</th>
                                <th>N° Colis</th>
                                <th>N° Bordereau</th>
                                <th>Montant annoncé</th>
                                <th>Nature colis</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($arriveeColis as $colis)
                                <tr>
                                    <td>
                                        <input type="hidden" name="colis_id[]" value="{{$colis->id}}">
                                        <select name="asColis_edit[]" class="form-control">
                                            <option>{{$colis->colis}}</option>
                                            <option>Keep Safe</option>
                                            <option>Sac juste</option>
                                            <option>Pierres précieuses</option>
                                        </select>
                                    </td>
                                    <td><input type="number" name="asNumColis_edit[]" value="{{$colis->num_colis}}"
                                               class="form-control"/></td>
                                    <td><input type="text" name="asNumBordereau_edit[]" value="{{$colis->bordereau}}"
                                               class="form-control"/></td>
                                    <td><input type="number" name="asMontantAnnonce_edit[]" value="{{$colis->montant}}"
                                               class="form-control"/></td>
                                    <td><input type="text" name="asNatureColis_edit[]" value="{{$colis->nature}}"
                                               class="form-control"/></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <select name="asColis[]" class="form-control">
                                        <option>Keep Safe</option>
                                        <option>Sac juste</option>
                                        <option>Pierres précieuses</option>
                                    </select>
                                </td>
                                <td><input type="number" name="asNumColis[]" class="form-control"/></td>
                                <td><input type="text" name="asNumBordereau[]" class="form-control"/></td>
                                <td><input type="number" name="asMontantAnnonce[]" class="form-control"/></td>
                                <td><input type="text" name="asNatureColis[]" class="form-control"/></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <br/>
                <div class="form-group">
                    <button class="btn btn-sm btn-primary" type="submit" id="asSubmit">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#listeArriveeSite').DataTable({
                "language": {
                    "url": "French.json"
                }
            });

            $("#asDebutOperation").on("change", function () {
                const fin = $("#asFinOperation").val();
                if (fin !== undefined) {
                    console.log(fin);
                }
            });

            $("#asFinOperation").on("change", function () {
                const debut = $("#asDebutOperation").val();
                console.log("debut :", debut);
                console.log("fin :", this.value);
                const debutDate = new Date(`01/01/2021 ${debut}`);
                const finDate = new Date(`01/01/2021 ${this.value}`);
                $("#asTempsOperation").val(diff_hours(debutDate, finDate));
            });

            function diff_hours(dt2, dt1) {
                let diff = (dt2.getTime() - dt1.getTime()) / 1000;
                //diff /= (60 * 60);         //For Hours
                diff /= (60);         // For Minutes
                return Math.abs(Math.round(diff));
            }

        });
    </script>
@endsection