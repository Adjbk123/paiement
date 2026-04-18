<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Reçu de versement</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 13px; color: #1a1a2e; background: #fff; }
.top-bar { background: #1e3a8a; height: 8px; width: 100%; }
.header-wrap { padding: 24px 32px 18px; border-bottom: 1px solid #e2e8f0; }
.header-table { width: 100%; }
.logo-cell { width: 80px; vertical-align: middle; }
.logo-cell img { width: 72px; border-radius: 0; object-fit: contain; }
.brand-cell { vertical-align: middle; padding-left: 14px; }
.brand-name { font-size: 18px; font-weight: bold; color: #1e3a8a; letter-spacing: .5px; }
.brand-sub { font-size: 11px; color: #64748b; margin-top: 2px; }
.recu-cell { text-align: right; vertical-align: middle; }
.recu-badge { display: inline-block; background: #16a34a; color: #fff; font-size: 11px; font-weight: bold; letter-spacing: 2px; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; }
.recu-ref { font-size: 11px; color: #94a3b8; margin-top: 5px; font-family: monospace; }
.status-banner { margin: 12px 32px 0; padding: 10px 18px; border-radius: 6px; background: #f0fdf4; border-left: 4px solid #16a34a; }
.status-label { font-weight: bold; font-size: 13px; color: #15803d; }
.body-wrap { padding: 16px 32px 22px; }
.section-title { font-size: 10px; font-weight: bold; color: #1e3a8a; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; padding-bottom: 4px; border-bottom: 1px solid #e2e8f0; }
.info-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; }
.info-table td { padding: 8px 10px; font-size: 12.5px; border-bottom: 1px solid #f1f5f9; }
.info-table td.label { color: #64748b; font-weight: bold; width: 38%; background: #f8fafc; }
.info-table td.value { color: #1e293b; }
.amount-hero { background: linear-gradient(135deg, #16a34a, #15803d); border-radius: 10px; padding: 20px 24px; margin-bottom: 22px; }
.amount-hero-table { width: 100%; }
.amount-label { color: rgba(255,255,255,.75); font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
.amount-value { color: #fff; font-size: 28px; font-weight: bold; margin-top: 4px; }
.amount-sub { color: rgba(255,255,255,.7); font-size: 11px; margin-top: 2px; }
.amount-right { text-align: right; vertical-align: middle; }
.amount-right-inner { display: inline-block; background: rgba(255,255,255,.15); border-radius: 8px; padding: 8px 14px; }
.amount-right-label { color: rgba(255,255,255,.75); font-size: 10px; font-weight: bold; text-transform: uppercase; }
.amount-right-value { color: #fff; font-size: 13px; font-weight: bold; margin-top: 3px; }
.progress-wrap { margin-bottom: 22px; }
.progress-labels { width: 100%; margin-bottom: 5px; }
.progress-labels td { font-size: 11px; }
.p-left { color: #64748b; }
.p-right { text-align: right; color: #1e3a8a; font-weight: bold; }
.progress-bg { background: #e2e8f0; border-radius: 10px; height: 8px; width: 100%; }
.progress-fill { background: #16a34a; border-radius: 10px; height: 8px; }
.progress-amounts { width: 100%; margin-top: 5px; }
.pa-left { font-size: 11px; color: #16a34a; font-weight: bold; }
.pa-right { text-align: right; font-size: 11px; color: #dc2626; font-weight: bold; }
.footer-wrap { margin: 0 32px; padding: 14px 0 20px; border-top: 1px solid #e2e8f0; font-size: 10.5px; color: #64748b; line-height: 1.6; }
.footer-bottom { background: #f8fafc; padding: 8px 32px; font-size: 10px; color: #94a3b8; text-align: center; }
.bottom-bar { background: #1e3a8a; height: 4px; }
</style>
</head>
<body>

@php
$logo        = !empty($parametres?->photo) && file_exists(public_path('uploads/'.$parametres->photo))
               ? public_path('uploads/'.$parametres->photo)
               : public_path('uploads/default.png');
$siteName    = $parametres?->website_name ?? 'MAFLYT SARL';
$phone       = $parametres?->phone1 ?? '';
$phone2      = $parametres?->phone2 ?? '';
$email       = $parametres?->email1 ?? '';
$address     = $parametres?->address ?? '';
$inscription = $tranche->inscription;

$totalFmt   = number_format($inscription->montantTotal(), 0, ',', ' ');
$payeFmt    = number_format($inscription->totalPaye(), 0, ',', ' ');
$resteFmt   = number_format($inscription->resteAPayer(), 0, ',', ' ');
$pct        = $inscription->montantTotal() > 0
              ? round($inscription->totalPaye() / $inscription->montantTotal() * 100)
              : 0;
$montantFmt = number_format($tranche->montant_tranche, 0, ',', ' ');
@endphp

<div class="top-bar"></div>

<!-- HEADER -->
<div class="header-wrap">
    <table class="header-table">
        <tr>
            <td class="logo-cell"><img src="{{ $logo }}" alt="Logo"></td>
            <td class="brand-cell">
                <div class="brand-name">{{ $siteName }}</div>
                @if($address)<div class="brand-sub">{{ $address }}</div>@endif
                @if($phone)<div class="brand-sub">{{ $phone }}@if($phone2) · {{ $phone2 }}@endif</div>@endif
                @if($email)<div class="brand-sub">{{ $email }}</div>@endif
            </td>
            <td class="recu-cell">
                <div class="recu-badge">Reçu de versement</div>
                <div class="recu-ref">{{ $tranche->reference }}</div>
                <div class="recu-ref">{{ $tranche->created_at->format('d/m/Y à H:i') }}</div>
            </td>
        </tr>
    </table>
</div>

<div class="status-banner">
    <span class="status-label">✔ Versement confirmé</span>
</div>

<div class="body-wrap">

    <!-- MONTANT HERO -->
    <div class="amount-hero">
        <table class="amount-hero-table">
            <tr>
                <td>
                    <div class="amount-label">Montant versé</div>
                    <div class="amount-value">{{ $montantFmt }} FCFA</div>
                    <div class="amount-sub">Formation : {{ $inscription->option->nom ?? 'N/A' }}</div>
                </td>
                <td class="amount-right">
                    <div class="amount-right-inner">
                        <div class="amount-right-label">Code de suivi</div>
                        <div class="amount-right-value">{{ $inscription->token ?? '—' }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- PROGRESSION -->
    @if($inscription->montantTotal() > 0)
    <div class="section-title">Progression du paiement</div>
    <div class="progress-wrap">
        <table class="progress-labels">
            <tr>
                <td class="p-left">{{ $payeFmt }} FCFA payés sur {{ $totalFmt }} FCFA</td>
                <td class="p-right">{{ $pct }}%</td>
            </tr>
        </table>
        <div class="progress-bg">
            <div class="progress-fill" style="width:{{ $pct }}%;"></div>
        </div>
        <table class="progress-amounts">
            <tr>
                <td class="pa-left">Payé : {{ $payeFmt }} FCFA</td>
                <td class="pa-right">Reste : {{ $resteFmt }} FCFA</td>
            </tr>
        </table>
    </div>
    @endif

    <!-- INFOS CLIENT -->
    <div class="section-title">Informations du bénéficiaire</div>
    <table class="info-table">
        <tr><td class="label">Nom complet</td><td class="value">{{ $inscription->prenoms }} {{ $inscription->nom }}</td></tr>
        <tr><td class="label">Email</td><td class="value">{{ $inscription->email }}</td></tr>
        <tr><td class="label">Téléphone</td><td class="value">{{ $inscription->phone }}</td></tr>
    </table>

    <!-- DÉTAIL TRANSACTION -->
    <div class="section-title">Détail du versement</div>
    <table class="info-table">
        <tr><td class="label">Référence versement</td><td class="value" style="font-family:monospace;">{{ $tranche->reference }}</td></tr>
        <tr><td class="label">ID Transaction</td><td class="value" style="font-family:monospace;">{{ $tranche->transaction_id ?? '—' }}</td></tr>
        <tr><td class="label">Date &amp; heure</td><td class="value">{{ $tranche->created_at->format('d/m/Y à H:i') }}</td></tr>
        <tr><td class="label">Montant versé</td><td class="value"><strong style="color:#16a34a;">{{ $montantFmt }} FCFA</strong></td></tr>
        <tr><td class="label">Total payé à ce jour</td><td class="value">{{ $payeFmt }} FCFA</td></tr>
        <tr><td class="label">Reste à payer</td><td class="value" style="color:#dc2626;font-weight:bold;">{{ $resteFmt }} FCFA</td></tr>
    </table>

</div>

<div class="footer-wrap">
    <p>
        <strong>* Pour toute réclamation, plainte ou suggestion</strong>, veuillez contacter
        <strong>{{ $siteName }}</strong>
        @if($phone) au <strong>{{ $phone }}</strong>@endif
        @if($phone2) / <strong>{{ $phone2 }}</strong>@endif
        @if($email) ou par email à <strong>{{ $email }}</strong>@endif.
        Si vous n'avez pas satisfaction, contactez l'équipe <strong>FedaPay</strong>
        au <strong>+229 63 95 43 13</strong> / <strong>+229 99 45 11 11</strong>
        ou à <strong>support@fedapay.com</strong>.
    </p>
</div>
<div class="footer-bottom">
    {{ $siteName }} © {{ date('Y') }} — Document généré automatiquement.
</div>
<div class="bottom-bar"></div>

</body>
</html>
