@extends('base')

@section('main')
    <div class="burval-container">
        <div><h2 class="heading">Facture</h2></div>
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

        <a href="/comptabilite-fature-liste" class="btn btn-info btn-sm">Nouveau</a>
        <br>
        <br>
        <div class="row">
            <div class="col">
                <table class="table table-bordered" style="width: 100%;" id="liste">
                    <thead>
                        <tr>
                            <td>Facture</td>
                            <td>ID Client</td>
                            <td>Période</td>
                            <td>Montant</td>
                            <td>Date dépot</td>
                            <td>Date échéance</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($factures as $facture)
                        <tr>
                            <td>{{$facture->numeroFacture}}</td>
                            <td>{{$facture->client}}</td>
                            <td>{{$facture->periode}}</td>
                            <td>{{$facture->montant}}</td>
                            <td>{{$facture->dateDepot}}</td>
                            <td>{{$facture->dateEcheance}}</td>
                            <td>
                                <div class="two-columns">
                                    <div>
                                        <a href="{{ route('comptabilite-fature.edit', $facture->id)}}" class="btn btn-primary btn-sm">Modifier</a>
                                    </div>
                                    <div>
                                        <form action="{{ route('comptabilite-fature.destroy', $facture->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                                        </form>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#liste').DataTable({
                "language": {
                    "url": "French.json"
                }
            });
        });
    </script>
@endsection
