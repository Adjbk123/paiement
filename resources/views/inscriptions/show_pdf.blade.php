<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription {{ $inscription->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2, h3 { text-align: center; margin: 0; }
        .header { margin-bottom: 20px; text-align: center; }
        .logo { width: 100px; display: block; margin: 0 auto 10px; }
        .date { text-align: right; font-size: 10px; margin-top: 5px; }
        .footer { text-align: center; font-size: 10px; margin-top: 30px; }
    </style>
</head>
<body>
@php
    $logo = $parametres?->photo
        ? public_path('uploads/' . $parametres->photo)
        : public_path('uploads/default.png');
    $siteName = $parametres?->website_name ?? 'MAFLYT';
    $ens = optional($inscription->enseignement)->nom;
@endphp

<div class="header">
    <img src="{{ $logo }}" class="logo">
    <h2>{{ $siteName }}</h2>
    <h3>Inscription #{{ $inscription->id }}</h3>
    <div class="date">Généré le : {{ date('d/m/Y') }}</div>
</div>

<table>
    <tbody>
        <tr>
            <th>Nom complet</th>
            <td>{{ $inscription->nom }} {{ $inscription->prenoms }}</td>
        </tr>
        <tr>
            <th>Enseignement</th>
            <td>
                @if($ens === 'Autre' && $inscription->autre_enseignement)
                    {{ $inscription->autre_enseignement }}
                @else
                    {{ $ens ?? '-' }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Localisation</th>
            <td>
                @if(in_array($ens, ['Maternel', 'Primaire']))
                    {{ optional($inscription->circonscription)->nom ?? '-' }}
                @else
                    {{ optional($inscription->province)->nom ?? '-' }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Formation</th>
            <td>
                @if(in_array($ens, ['Maternel', 'Primaire']))
                    {{ optional($inscription->formation)->nom ?? '-' }}
                @else
                    {{ optional($inscription->region)->nom ?? '-' }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Montant</th>
            <td>{{ number_format($inscription->montant, 0, ',', ' ') }} FCFA</td>
        </tr>
        
        <tr>
            <th>Contact</th>
            <td>{{ $inscription->phone ?? '-' }} <br> {{ $inscription->email ?? '-' }}</td>
        </tr>
    </tbody>
</table>

<div class="footer">
    Document généré automatiquement par {{ $siteName }}.
</div>
</body>
</html>
