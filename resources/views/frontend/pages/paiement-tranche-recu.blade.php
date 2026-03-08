<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu de Paiement</title>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 13px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            margin-bottom: 10px;
        }

        h2, h3 {
            margin: 5px 0;
        }

        .date {
            font-size: 12px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>

@php
    $logoPath = $parametres?->photo
        ? public_path('uploads/' . $parametres->photo)
        : public_path('uploads/default.png');

    $logoBase64 = file_exists($logoPath)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : null;

    $siteName = $parametres?->website_name ?? 'MAFLYT';
@endphp

<div class="header">
    @if($logoBase64)
        <img src="{{ $logoBase64 }}" class="logo">
    @endif

    <h2>{{ $siteName }}</h2>
    <h3>Reçu de Paiement</h3>
    <div class="date">Généré le : {{ date('d/m/Y') }}</div>
</div>

<hr>

<p><strong>Nom :</strong> {{ $paiement->nom }} {{ $paiement->prenoms }}</p>
<p><strong>Email :</strong> {{ $paiement->email }}</p>
<p><strong>Référence :</strong> {{ $paiement->reference }}</p>

<hr>

<h4>Détails des Tranches Payées</h4>

<table>
    <thead>
        <tr>
            <th>Montant</th>
            <th>Statut</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tranches ?? [$tranche] as $item)
        <tr>
            <td>{{ number_format($item->montant_tranche, 0, ',', ' ') }} FCFA</td>
            <td>{{ ucfirst($item->status) }}</td>
            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<hr>

<p><strong>Total payé :</strong> {{ number_format($totalPaye, 0, ',', ' ') }} FCFA</p>
<p><strong>Reste à payer :</strong> {{ number_format($reste, 0, ',', ' ') }} FCFA</p>

<div class="footer">
    Merci pour votre confiance – {{ $siteName }}
</div>

</body>
</html>
