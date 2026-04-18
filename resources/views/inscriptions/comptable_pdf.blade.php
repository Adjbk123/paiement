<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Point Comptable</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .logo { width: 80px; margin-bottom: 10px; border-radius: 0; }
        .title { font-size: 18px; font-weight: bold; text-transform: uppercase; margin: 5px 0; }
        .subtitle { font-size: 13px; color: #666; }
        .summary-card { background: #fdfdfd; padding: 10px; border: 1px solid #ddd; margin-bottom: 20px; }
        .total-box { font-size: 16px; font-weight: bold; text-align: right; margin-top: 20px; padding: 10px; background: #eee; }
        .footer { margin-top: 50px; }
        .signature-box { float: right; width: 200px; text-align: center; margin-top: 20px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .bg-light { background-color: #fcfcfc; }
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
    @if(file_exists($logo))
        <img src="{{ $logo }}" class="logo">
    @endif
    <div class="title">{{ $siteName }}</div>
    <div class="subtitle">POINT COMPTABLE DES ENCAISSEMENTS</div>
    <div style="margin-top: 5px;">Période du <strong>{{ date('d/m/Y', strtotime($dateDebut)) }}</strong> au <strong>{{ date('d/m/Y', strtotime($dateFin)) }}</strong></div>
</div>

<div class="summary-card">
    <h4 style="margin: 0 0 10px 0; border-bottom: 1px solid #eee; padding-bottom: 5px;">RÉCAPITULATIF PAR ENSEIGNEMENT</h4>
    <table>
        <thead>
            <tr>
                <th>Type d'enseignement</th>
                <th class="text-center">Nombre d'inscrits</th>
                <th class="text-right">Montant Total (FCFA)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statsEnseignement as $nom => $data)
            <tr>
                <td>{{ $nom }}</td>
                <td class="text-center">{{ $data['count'] }}</td>
                <td class="text-right">{{ number_format($data['total'], 0, ',', ' ') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background: #f0f0f0; font-weight: bold;">
                <td>TOTAL GÉNÉRAL</td>
                <td class="text-center">{{ $inscriptions->count() }}</td>
                <td class="text-right">{{ number_format($totalMontant, 0, ',', ' ') }}</td>
            </tr>
        </tfoot>
    </table>
</div>

<h4 style="margin-top: 30px; text-decoration: underline;">DÉTAIL DES TRANSACTIONS</h4>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Date & Heure</th>
            <th>Bénéficiaire</th>
            <th>Référence / Token</th>
            <th class="text-right">Montant (FCFA)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inscriptions as $index => $ins)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $ins->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <strong>{{ $ins->nom }} {{ $ins->prenoms }}</strong><br>
                <small>{{ optional($ins->option)->nom }}</small>
            </td>
            <td><code>{{ $ins->token ?? '—' }}</code></td>
            <td class="text-right">{{ number_format($ins->totalPaye(), 0, ',', ' ') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="total-box">
    MONTANT TOTAL ENCAISSÉ : {{ number_format($totalMontant, 0, ',', ' ') }} FCFA
</div>

<div class="footer">
    <div style="float: left;">
        Imprimé le : {{ date('d/m/Y à H:i') }}
    </div>
    <div class="signature-box">
        <p>Le Comptable / Caissier</p>
        <div style="height: 80px;"></div>
        <p>(Signature et Cachet)</p>
    </div>
</div>

</body>
</html>
