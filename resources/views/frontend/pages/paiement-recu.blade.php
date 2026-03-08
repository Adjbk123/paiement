<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Reçu de paiement</title>

<style>

body{
font-family: Arial, sans-serif;
margin:0;
padding:0;
background:#ffffff;
color:#333;
}

.container{
max-width:700px;
margin:20px auto;
background:#ffffff;
border-radius:8px;
padding:25px;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

.header{
text-align:center;
border-bottom:2px solid #007bff;
padding-bottom:15px;
margin-bottom:20px;
}

.header img{
max-height:70px;
margin-bottom:10px;
}

.header h2{
margin:0;
color:#007bff;
font-size:20px;
}

.title{
text-align:center;
font-size:18px;
font-weight:bold;
color:#007bff;
margin:20px 0;
}

.content table{
width:100%;
border-collapse:collapse;
font-size:14px;
}

.content th{
text-align:left;
background:#f1f1f1;
padding:10px;
width:35%;
border-bottom:1px solid #ddd;
}

.content td{
padding:10px;
border-bottom:1px solid #ddd;
}

.amount{
font-weight:bold;
color:#28a745;
}

.status-approved{
color:#28a745;
font-weight:bold;
}

.status-pending{
color:#f39c12;
font-weight:bold;
}

.status-failed{
color:#e74c3c;
font-weight:bold;
}

.footer{
display:block;
white-space:normal;
font-size:11px;
line-height:1.5;
border-top:1px solid #ddd;
padding-top:10px;
margin-top:25px;
}

</style>

</head>

<body>

<div class="container">

@php
$logo = !empty($parametres?->photo) && file_exists(public_path('uploads/'.$parametres->photo))
? asset('uploads/'.$parametres->photo)
: asset('uploads/default.png');

$siteName = $parametres?->website_name ?? 'MAFLYT SARL';
@endphp


<div class="header">
<img src="{{ $logo }}" alt="Logo">
<h2>{{ $siteName }}</h2>
</div>

<div class="title">
REÇU DE PAIEMENT
</div>


<div class="content">

<table>

<tr>
<th>Référence</th>
<td>{{ $paiement->reference }}</td>
</tr>

<tr>
<th>ID Transaction</th>
<td>{{ $paiement->transaction_id ?? 'Non disponible' }}</td>
</tr>

<tr>
<th>Statut du paiement</th>
<td class="status-{{ $paiement->status }}">
{{ ucfirst($paiement->status) }}
</td>
</tr>

<tr>
<th>Nom complet</th>
<td>{{ $paiement->prenoms }} {{ $paiement->nom }}</td>
</tr>

<tr>
<th>Email</th>
<td>{{ $paiement->email }}</td>
</tr>

<tr>
<th>Téléphone</th>
<td>{{ $paiement->phone }}</td>
</tr>

<tr>
<th>Option</th>
<td>{{ $paiement->option->nom ?? 'N/A' }}</td>
</tr>

<tr>
<th>Enseignement</th>
<td>

@if ($paiement->enseignement)
{{ $paiement->enseignement->nom }}
@else
Autre : {{ $paiement->autre_enseignement }}
@endif

</td>
</tr>

<tr>
<th>Montant payé</th>
<td class="amount">
{{ number_format($paiement->montant,0,',',' ') }} XOF
</td>
</tr>

<tr>
<th>Date</th>
<td>
{{ $paiement->created_at->format('d/m/Y H:i') }}
</td>
</tr>

</table>

</div>


<div class="footer">

<p>
<strong>* Pour toute réclamation, plainte ou suggestion</strong>, veuillez contacter
<strong>{{ $siteName }}</strong> au <strong>{{ $parametres->phone1 }}</strong>
ou par email au <strong>{{ $parametres->email1 }}</strong>.
</p>

<p>
Si vous n'avez pas satisfaction, contactez l'équipe
<strong>FedaPay</strong> au
<strong>+229 63 95 43 13</strong> / <strong>+229 99 45 11 11</strong>,
ou envoyez un email à <strong>support@fedapay.com</strong>
ou encore écrivez sur le tchat du site
<strong>www.fedapay.com</strong>.
</p>

<p style="margin-top:10px;">
{{ $siteName }} © {{ date('Y') }} | Adresse : {{ $parametres->address }}
</p>

</div>

</div>

</body>

</html>
