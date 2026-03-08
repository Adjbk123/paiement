<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>INVOCE-RECETTE</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 30px;
            margin-top: 30px;
            margin-bottom: 32px;
            font-family: sans-serif;
            padding: 20px 0px;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <h2 class="text-center">EGLISE EVANGELIQUE DES ASSEMBLEES DE DIEU DU BENIN</h2>
                
                <h3 class="text-center">SECTION : Adjarra </h3>
                <h3 class="text-center">EGLISE LOCALE : Temple Schilo de Kétoukpè</h3>
            </tr>
            <h2 class="text-center">Fiche de Recettes Locales</h2>
        </thead>
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
            <thead>
                    
                    <tr>
                        <th class="text-center">Semaines</th>
                       
                        <th class="text-center">Dimes</th>
                        <th class="text-center">Offrandes </th>
                        <th class="text-center">Offrandes Mardi</th>
                        <th class="text-center">Offrandes jeudi</th>
                        <th class="text-center">Offrandes speciales</th>
                        <th class="text-center">EDL</th>
                        <th class="text-center">Action de Grace</th>
                        <th class="text-center">DNAM</th>
                        <th class="text-center">Autre</th>
                        <th class="text-center">Total</th>
                        
                        
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
                            <td>{{ $recette->dime + $recette->offrande + $recette->offrande_m + $recette->offrande_j+ $recette->offrande_special + $recette->edl + $recette->action_grace + $recette->dnam + $recette->autre}}</td>
                            
                            
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
       <div class="heading">
            <table style="border-collapse:collapse;" >
                <thead>
                    <tr class="text-center">
                            
                        <th class="text-center" style="border:none;">
                        Le Pasteur
                        </th>
                        <th class="text-center" style="border:none;">
                        Le Trésorier
                        </th> 
                    </tr>
                </thead> 
           </table>
       </div>
    </div>
</body>
</html>


