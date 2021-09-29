@extends('base')

@section('main')
    <div class="burval-container">
        <div><h2 class="heading">Arrivée tournée</h2></div>
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

        <table class="table table-bordered table-hover" id="table" style="width: 100%">
            <thead>
            <tr>
                <td>Création</td>
                <td>Date</td>
                <td>Centre régional</td>
                <td>Centre</td>
                <td>N°Tournée</td>
                <td>Véhicule</td>
                <td>Chauffeur</td>
                <td>Montant collecté</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($departTournee as $depart)
                <tr>
                    <td>{{$depart->created_at}}</td>
                    <td>{{$depart->date}}</td>
                    <td>{{$depart->centre}}</td>
                    <td>{{$depart->centre_regional}}</td>
                    <td>{{$depart->numeroTournee}}</td>
                    <td>{{strtoupper($depart->vehicules->immatriculation) ?? 'vehicule supprimé ' . $depart->idVehicule}}</td>
                    <td>{{$depart->chauffeurs->nomPrenoms ?? 'Peronnel non disponible ' . $depart->chauffeur}}</td>
                    <td>{{$depart->sites->sum("montant")}}</td>
                    <td  style="width: 70px;">
                        <div>
                            <a href="{{ route('arrivee-tournee.edit',$depart->id)}}" class="btn btn-primary btn-sm"></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function () {
                $('#table').DataTable({
                    "language": {
                        "url": "French.json"
                    },
                    "order": [[ 0, "desc" ]]
                });
            });
        </script>
        <script>
            function supprimer(id, e) {
                if (confirm("Confirmer la suppression?")) {
                    const token = "{{ csrf_token() }}";
                    $.ajax({
                        url: "depart-tournee/" + id,
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
                            document.getElementById("table").deleteRow(indexLigne);
                        },
                        error: function (err) {
                            console.error(err.responseJSON.message);
                            alert(err.responseJSON.message ?? "Une erreur s'est produite");
                        }
                    }).done(function () {
                        // TODO hide loader
                    });
                }
            }
        </script>
@endsection