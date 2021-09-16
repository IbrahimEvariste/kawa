@extends('base')

@section('main')
    <div class="burval-container">
        <div><h2 class="heading">Liste Synthèse de Tournée</h2></div>
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

        <br/>
        <p>Maincourante</p>
        <table class="table table-bordered table-hover" id="listeMaincourante">
            <thead>
            <tr>
                <td>ID</td>
                <td>Date</td>
                <td>N°Tournée</td>
                <td>Véhicule</td>
                <td>Départ centre</td>
                <td>Km départ</td>
                <td>Carburant départ</td>
                <td>Arrivée centre</td>
                <td>Km arrivée</td>
                <td>Carburant arrivée</td>
                <td>Km parcouru</td>
                <td>Temps tournée</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($tournees as $tournee)
                <tr>
                    <td>{{$tournee->id}}</td>
                    <td>{{$tournee->date}}</td>
                    <td>{{$tournee->numeroTournee}}</td>
                    <td>{{$tournee->vehicules->immatriculation ?? "Donnée indisponible"}}</td>
                    <td></td>
                    <td>{{$tournee->departCentre[0]->kmDepart ?? ""}}</td>
                    <td>{{$tournee->departCentre[0]->niveauCarburant ?? ""}}</td>
                    <td></td>
                    <td>{{$tournee->arriveeCentre[0]->kmArrive ?? "Donnée indisponible"}}</td>
                    <td>{{$tournee->arriveeCentre[0]->niveauCarburant ?? "Donnée indisponible"}}</td>
                    <td>{{$tournee->departCentre[0]->kmDepart - $tournee->arriveeCentre[0]->kmArrive}}</td>
                    <td></td>
                    <td>
                        <button onclick="supprimer('{{$tournee->id}}', this)" class="btn btn-sm btn-danger"></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <script>
        $(document).ready(function () {
            $('#listeMaincourante').DataTable({
                "language": {
                    "url": "French.json"
                }
            });
        });
    </script>
    <script>
        function supprimer(id, e) {
            if (confirm("Confirmer la suppression? Cela entrainera la suppression de départ tournée.")) {
                const token = "{{ csrf_token() }}";
                $.ajax({
                    url: "maincourante/" + id,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        _token: token,
                    },
                    success: function (response) {
                        console.log(response);
                        alert("Suppression effectuée");
                        const indexLigne = $(e).closest('tr').get(0).rowIndex;
                        document.getElementById("listeMaincourante").deleteRow(indexLigne);
                    },
                    error: function () {
                        alert("Une erreur s'est produite");
                    }
                })


            }

        }
    </script>
@endsection