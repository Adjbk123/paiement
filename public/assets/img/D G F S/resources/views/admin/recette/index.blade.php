@extends('layouts.admin')

@section('content')
<div class="card m-3 shadow">
        <div class="card-header">
            <h3>ETAT SIMPLIFIE DES RECETTES 
                <a href="{{ url('admin/recette/create')}}" class="btn btn-primary btn-sm float-end m-1 ">AJOUTER</a>
                <a href="{{ url('admin/recette/generateInvoice')}}" class="btn btn-success btn-sm float-end m-1">TELECHARGER</a>
                <a href="{{ url('admin/recette/invoice')}}" class="btn btn-warning btn-sm float-end m-1 h6">VOIR LE RAPPORT</a>
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    
                    <tr>
                        <th class="text-center">Semaines</th>
                       
                        <th class="text-center">Dimes</th>
                        <th class="text-center">Offrandes Dimanche</th>
                        <th class="text-center">Offrandes Mardi</th>
                        <th class="text-center">Offrandes jeudi</th>
                        <th class="text-center">Offrandes speciales</th>
                        <th class="text-center">EDL</th>
                        <th class="text-center">Action de Grace</th>
                        <th class="text-center">DNAM</th>
                        <th class="text-center">Autre</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                @forelse($recettes as $recette)
                        <tr class="text-center">
                            <td>{{$recette->semaine}}</td>
                           
                            <td>{{$recette->dime}}</td>
                            <td>{{$recette->offrande}}</td>
                            <td>{{$recette->offrande_m}}</td>
                            <td>{{$recette->offrande_j}}</td>
                            <td>{{$recette->offrande_special}}</td>
                            
                            <td>{{$recette->edl}}</td>
                            <td>{{$recette->action_grace}}</td>
                            <td>{{$recette->dnam}}</td>
                            <td>{{$recette->autre}}</td>
                            <td>{{ $recette->dime + $recette->offrande + $recette->offrande_m + $recette->offrande_j + $recette->offrande_special + $recette->edl + $recette->action_grace + $recette->dnam + $recette->autre}}</td>
                            
                            <td>
                                <a href="{{url('admin/recette/'.$recette->id. '/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{url('admin/recette/'.$recette->id. '/delete')}}" onclick="return confirm('vous etes sur de vouloir suprimer cette fichirer?')"  class="btn btn-sm btn-danger">Suprimer</a>
                            </td>
                        </tr>
                        
                        @empty
                        <tr>
                            <td colspan="7" >Pas de recette disponible</td>
                        </tr>
                    @endforelse
                </tbody>
                <tbody>
                    <th class="text-center">
                        TOTAL
                    </th>
                  
                    <th class="text-center">
                    {{$Total1 =$recette->sum('dime')}}
                    </th>
                    <th class="text-center">
                    {{$Total2 = $recette->sum('offrande')}}
                    </th>
                    <th class="text-center">
                    {{$Total3 = $recette->sum('offrande_m')}}
                    </th>
                    <th class="text-center">
                    {{$Total4 = $recette->sum('offrande_j')}}
                    </th>
                   
                    <th class="text-center">
                    {{$Total5 = $recette->sum('offrande_special')}}
                    </th>
                    <th class="text-center">
                    {{$Total6 = $recette->sum('edl')}}
                    </th>
                    <th class="text-center">
                    {{$Total7 = $recette->sum('action_grace')}}
                    </th>
                    <th class="text-center">
                    {{$Total8 = $recette->sum('dnam')}}
                    </th>
                    <th>
                    {{$Total9 = $recette->sum('autre')}}
                    </th>
                    <th class="text-center">
                    {{$TotalR =  $Total1 + $Total2 + $Total3 + $Total4 + $Total5 + $Total6 + $Total7 + $Total8 + $Total9 }}
                    </th>
                </tbody>

                
            </table>
            
        </div>
    </div>
@endsection

