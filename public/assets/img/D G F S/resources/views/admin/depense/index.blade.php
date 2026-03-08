@extends('layouts.admin')

@section('content')

<div class="card m-3 shadow">
        <div class="card-header">
            <h4>ETAT SIMPLIFIE  DES DEPENSES HEBDOMADAIRE 
                <a href="{{ url('admin/depense/create')}}" class="btn btn-primary btn-sm float-end m-1">AJOUTER</a>
                <a href="{{ url('admin/depense/generateInvoice')}}" class="btn btn-success btn-sm float-end m-1">TELECHARGER</a>
                <a href="{{ url('admin/depense/invoice')}}" class="btn btn-warning btn-sm float-end h6 m-1">VOIR LE RAPPORT</a>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
            
                <thead>
                    <tr>
                        <th>Rubriques</th>
                        
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Salaire</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->salaire }}</td>
                        @endforeach
                        <td colspan="">{{$Total1 = $depense->sum('salaire')}}</td>
                    </tr>
                    <tr>
                        <td>Eau</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->eau }}</td>
                        @endforeach
                        <td colspan="">{{$Total2 = $depense->sum('eau')}}</td>
                    </tr>
                    <tr>
                        <td>Eletricité</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->eletricite }}</td>
                        @endforeach
                        <td colspan="">{{$Total3 = $depense->sum('eletricite')}}</td>
                    </tr>
                    <tr>
                        <td>Communication</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->communication }}</td>
                        @endforeach
                        <td colspan="">{{$Total4 = $depense->sum('communication')}}</td>
                    </tr>
                    <tr>
                        <td>Carburant</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->carburant }}</td>
                        @endforeach
                        <td colspan="">{{$Total5 = $depense->sum('carburant')}}</td>
                    </tr>
                    <tr>
                        <td>Déplacement</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->deplacement }}</td>
                        @endforeach
                        <td colspan="">{{$Total6 = $depense->sum('deplacement')}}</td>
                    </tr>
                    <tr>
                        <td>Santé</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->sante }}</td>
                        @endforeach
                        <td colspan="">{{$Total7 = $depense->sum('sante')}}</td>
                    </tr>
                    <tr>
                        <td>Entretien</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->entretien }}</td>
                        @endforeach
                        <td colspan="">{{$Total8 = $depense->sum('entretien')}}</td>
                    </tr>
                   
                    
                    <tr>
                        <td>20 %</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->le_20 }}</td>
                        @endforeach
                        <td colspan="">{{$Total11 = $depense->sum('le_20')}}</td>
                    </tr>
                    <tr>
                        <td>15 %</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->le_15 }}</td>
                        @endforeach
                        <td colspan="">{{$Total12 = $depense->sum('le_15')}}</td>
                    </tr>
                    <tr>
                        <td>Loyer</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->loyer }}</td>
                        @endforeach
                        <td colspan="">{{$Total13 = $depense->sum('loyer')}}</td>
                    </tr>
                   
                    <tr>
                        <td>FOSPA</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->fospa }}</td>
                        @endforeach
                        <td colspan="">{{$Total15 = $depense->sum('fospa')}}</td>
                    </tr>
                    <tr>
                        <td>DNAM</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->dnam }}</td>
                        @endforeach
                        <td colspan="">{{$Total16 = $depense->sum('dnam')}}</td>
                    </tr>
                    <tr>
                        <td>Autres</td>
                        @foreach ($depenses as $depense)
                        <td>{{ $depense->autre }}</td>
                        @endforeach
                        <td colspan="">{{$Total17 = $depense->sum('autre')}}</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        @foreach ($depenses as $depense)
                        <td>{{$depense->autre + $depense->dnam + $depense->fospa + $depense->fas + $depense->loyer + $depense->le_15 + $depense->le_20 + $depense->amotisement + $depense->fourniture + $depense->entretien + $depense->sante + $depense->deplacement + $depense->carburant + $depense->communication + $depense->eletricite + $depense->eau + $depense->salaire}} </td>
                        @endforeach
                        <td colspan="">{{$TotalR = $Total1 + $Total2 + $Total3 + $Total4 + $Total5 + $Total6 + $Total7 + $Total8   + $Total11 + $Total12 + $Total13  + $Total15 + $Total16 + $Total17 }}</td>
                    </tr>
                    <tr>
                        <td>Action</td>
                        @foreach ($depenses as $depense)
                        <td>
                        <a href="{{url('admin/depense/'.$depense->id. '/edit')}}" class=" mb-2 btn btn-sm btn-success">Edit</a><br>
                        <a href="{{url('admin/depense/'.$depense->id. '/delete')}}" onclick="return confirm('vous etes sur de vouloir suprimer cette fichirer?')"  class="btn btn-sm btn-danger">Sup</a>
                        </td>
                        @endforeach
                    </tr>
                    
               
                </tbody>
            </table>

@endsection
