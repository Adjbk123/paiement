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
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
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
        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .signature-item {
            text-align: center;
            width: 30%;
        }
        .signature-item h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .signature-item img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <h3 class="text-center">EGLISE EVANGELIQUE DES ASSEMBLEES DE DIEU DU BENIN</h3>
                <h4 class="text-center">SECTION : Adjarra EGLISE LOCALE : Temple Schilo</h4> 
            </tr>
            <h4 class="text-center">ETAT SIMPLIFIE DES DEPENSES HEBDOMANDAIRE</h4>
            <h4 class="text-center">Période Commençant le ..................... Le finissant le ........................</h4>
        </thead>
        <div class="card-body">
        <table class="table table-bordered table-striped text-center">
            
                <thead>
                    <tr>
                        <th class="text-center">Rubriques</th>
                        
                        <th class="text-center">1</th>
                        <th class="text-center">2</th>
                        <th class="text-center">3</th>
                        <th class="text-center">4</th>
                        <th class="text-center">5</th>
                        <th class="text-center">6</th>
                        <th class="text-center">7</th>
                        <th class="text-center">8</th>
                        <th class="text-center">9</th>
                        <th class="text-center">10</th>
                        <th class="text-center">11</th>
                        <th class="text-center">Total</th>
                        
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
                        <td colspan="">{{$TotalR = $Total1 + $Total2 + $Total3 + $Total4 + $Total5 + $Total6 + $Total7 + $Total8 + $Total11 + $Total12 + $Total13 + $Total15 + $Total16 + $Total17 }}</td>
                    </tr>
                    
               
                </tbody>
            </table>
            <div class="heading">
            <table style="border-collapse:collapse;" >
                <thead>
                    <tr class="text-center">
                            
                        
                        <th class="text-center" style="border:none;">
                        Le Pasteur
                        </th>

                        <th class="text-center h1" style="border:none;">
                        Le trésorier 
                        </th>
                       
                    </tr>
                </thead> 
           </table>
       </div>

    </div>
</body>
</html>


