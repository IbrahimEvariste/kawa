@extends('base')

@section('main')
    <link rel="stylesheet" href="{{ asset('css/tabstyles.css') }}">
    <div class="burval-container">
        <div><h2 class="heading">Demande Achat</h2></div>
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

        <ul class="nav nav-tabs tabs-dark bg-dark" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="refuse-tab" data-toggle="tab" href="#refuse" role="tab"
                   aria-controls="demande" aria-selected="true">Achats refusés</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="valide-tab" data-toggle="tab" href="#valide" role="tab"
                   aria-controls="imputations" aria-selected="false">Achats validés</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="encours-tab" data-toggle="tab" href="#en-cours" role="tab"
                   aria-controls="imputations" aria-selected="false">Achats en cours</a>
            </li>
        </ul>
        <br>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="refuse" role="tabpanel" aria-labelledby="refuse-tab">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered" style="width: 100%;" id="liste">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>date</td>
                                <td>identite</td>
                                <td>service</td>
                                <td>Nom du responsable</td>
                                <td>Téléphone</td>
                                <td>Objet achat</td>
                                <td>Montant retenu</td>
                                <td>Actions</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($achatsRefuses as $demande)
                                <tr>
                                    <td>{{$demande->id}}</td>
                                    <td>{{$demande->date}}</td>
                                    <td>{{$demande->identite}}</td>
                                    <td>{{$demande->service}}</td>
                                    <td>{{$demande->nom_demandeur}}</td>
                                    <td>{{$demande->telephone_demandeur}}</td>
                                    <td>{{$demande->objet_achat}}</td>
                                    <td>{{$demande->montant_retenu}}</td>
                                    <td>
                                        <a href="{{ route('achat-demande.edit',$demande->id)}}"
                                           class="btn btn-primary btn-sm"></a>
                                        <form action="{{ route('achat-demande.destroy', $demande->id)}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="valide" role="tabpanel" aria-labelledby="valide-tab">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered" style="width: 100%;" id="liste1">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>date</td>
                                <td>identite</td>
                                <td>service</td>
                                <td>Nom du responsable</td>
                                <td>Téléphone</td>
                                <td>Objet achat</td>
                                <td>Montant retenu</td>
                                <td>Actions</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($achatsValides as $demande)
                                <tr>
                                    <td>{{$demande->id}}</td>
                                    <td>{{$demande->date}}</td>
                                    <td>{{$demande->identite}}</td>
                                    <td>{{$demande->service}}</td>
                                    <td>{{$demande->nom_demandeur}}</td>
                                    <td>{{$demande->telephone_demandeur}}</td>
                                    <td>{{$demande->objet_achat}}</td>
                                    <td>{{$demande->montant_retenu}}</td>
                                    <td>
                                        <a href="{{ route('achat-demande.edit',$demande->id)}}"
                                           class="btn btn-primary btn-sm"></a>
                                        <form action="{{ route('achat-demande.destroy', $demande->id)}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="en-cours" role="tabpanel" aria-labelledby="encours-tab">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered" style="width: 100%;" id="liste2">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>date</td>
                                <td>identite</td>
                                <td>service</td>
                                <td>Nom du responsable</td>
                                <td>Téléphone</td>
                                <td>Objet achat</td>
                                <td>Montant retenu</td>
                                <td>Actions</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($achatsEnCours as $demande)
                                <tr>
                                    <td>{{$demande->id}}</td>
                                    <td>{{$demande->date}}</td>
                                    <td>{{$demande->identite}}</td>
                                    <td>{{$demande->service}}</td>
                                    <td>{{$demande->nom_demandeur}}</td>
                                    <td>{{$demande->telephone_demandeur}}</td>
                                    <td>{{$demande->objet_achat}}</td>
                                    <td>{{$demande->montant_retenu}}</td>
                                    <td>
                                        <a href="{{ route('achat-demande.edit',$demande->id)}}"
                                           class="btn btn-primary btn-sm"></a>
                                        <form action="{{ route('achat-demande.destroy', $demande->id)}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <script>
            $(document).ready(function () {
                $('#liste').DataTable({
                    "language": {
                        "url": "French.json"
                    }
                });
                $('#liste1').DataTable({
                    "language": {
                        "url": "French.json"
                    }
                });
                $('#liste2').DataTable({
                    "language": {
                        "url": "French.json"
                    }
                });
            });
        </script>
@endsection
