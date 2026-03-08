<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id}}</title>

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
            margin-bottom: 10px !important;
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
    </style>
</head>
<body>
        <h1 class="text-center" style="text-decoration:underline;">FACTURE DE VENTE</h1>
    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2" >
                    <span>ETS Divine Grace Fifamè Service </span><br>
                    <span>IFU :RB/PNO/22A36289 </span> <br>
                    <span>RCCM :0202268792050 </span> <br>
                    <span>TEL :(229) 01 61 39 20 29/ 01 52 11 84 71</span> <br>
                </th>
                <th width="50%" colspan="2">
                    <span>Facture : #DGFS2025-{{ $order->id}}</span> <br>
                    <span>Date: {{$order->created_at->format('d-m-Y')}}</span> <br>
                    <span>Address: TCHAADA</span> <br>
                </th>
            </tr>
            
        </thead>
       
    </table>
    <table>
        <thead>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Details Des Commandes</th>
                <th width="50%" colspan="2">Details d'utilisateurs</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Id:</td>
                <td>{{ $order->id}}</td>

                <td>Nom:</td>
                <td>{{ $order->fullname}}</td>
                
            </tr>
            
            <tr>
                <td>Date Du commandes:</td>
                <td>{{$order->created_at->format('d-m-Y h:i A')}}</td>

                <td>Phone:</td>
                <td>{{$order->phone}}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Commandes
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Productes</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
            
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
            @endphp
            @foreach ($order->orderItems as $orderItem)
                <tr>
                    <td width="10%">{{$orderItem->id}}</td>
                    <td >{{$orderItem->product->name}}</td>
                    <td width="15%">{{$orderItem->price}} f cfa</td>
                    <td width="10%">{{$orderItem->quantity}}</td>
                    <td width="20%" class="fw-bold">{{$orderItem->quantity * $orderItem->price}} f cfa</td>
                    @php
                        $totalPrice += $orderItem->quantity * $orderItem->price;
                    @endphp
                </tr>
            @endforeach 
            <tr>
                <td colspan="4" class=" total-heading ">Total Amount: - <small>Inc. all vat/tax</small>: </td>
                <td colspan="1" class=" total-heading">{{$totalPrice}} f cfa</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Répartition des Paiements
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Type de Paiement</th>
                <th>Payé</th>
                
            </tr>
        </thead>
        <tbody>
           
            
            <tr>
                    
                <td width="50%">ESPECES</td>
                <td width="50%" class="total-heading">{{$totalPrice}} f cfa</td>
                
            </tr>
            
        </tbody>
    </table>
    <br>
    <p class="text-center">
        Merci d'avoir Choisir D G F S
    </p>

</body>
</html>


