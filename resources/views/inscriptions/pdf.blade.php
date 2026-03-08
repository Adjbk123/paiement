<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Inscriptions</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2, h3 { text-align: center; margin: 0; }
        .header { margin-bottom: 20px; text-align: center; } /* Centrer le contenu de l'en-tête */
        .logo { width: 100px; display: block; margin: 0 auto 10px; } /* Centrer l'image */
        .date { text-align: right; font-size: 10px; margin-top: 5px; }
        .total { margin-top: 15px; font-weight: bold; }
        .footer { text-align: center; font-size: 10px; margin-top: 30px; }
    </style>
</head>
<body>
@php
    $logo = $parametres?->photo
        ? public_path('uploads/' . $parametres->photo)
        : public_path('uploads/default.png');
    $siteName = $parametres?->website_name ?? 'MAFLYT';
@endphp

<div class="header">
    <img src="{{ $logo }}" class="logo">
    <h2>{{ $siteName }}</h2>
    <h3>Liste des Inscriptions</h3>
    <div class="date">Généré le : {{ date('d/m/Y') }}</div>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Enseignement</th>
            <th>Localisation</th>
            <th>Formation</th>


        </tr>
    </thead>
    <tbody>
        @foreach($inscriptions as $index => $inscription)
            @php
                $ens = optional($inscription->enseignement)->nom;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $inscription->nom }} {{ $inscription->prenoms }}</td>

                {{-- Enseignement / Autre --}}
                <td>
                    @if($ens === 'Autre' && $inscription->autre_enseignement)
                        {{ $inscription->autre_enseignement }}
                    @else
                        {{ $ens ?? '-' }}
                    @endif
                </td>

                {{-- Localisation --}}
                <td>
                    @if(in_array($ens, ['Maternel', 'Primaire']))
                        {{ optional($inscription->circonscription)->nom ?? '-' }}
                    @else
                        {{ optional($inscription->province)->nom ?? '-' }}
                    @endif
                </td>

                {{-- Formation --}}
                <td>
                    @if(in_array($ens, ['Maternel', 'Primaire']))
                        {{ optional($inscription->formation)->nom ?? '-' }}
                    @else
                        {{ optional($inscription->region)->nom ?? '-' }}
                    @endif
                </td>

                {{-- <td>{{ number_format($inscription->montant, 0, ',', ' ') }} FCFA</td> --}}
                {{-- <td>{{ ucfirst($inscription->status) }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>

<div class="total">
    Total Général : {{ number_format($totalMontant, 0, ',', ' ') }} FCFA
</div>

<div class="total">
    Total des inscriptions : {{ $inscriptions->count() }}
</div>

<div class="footer">
    Document généré automatiquement par {{ $siteName }}.
</div>
</body>
</html>
