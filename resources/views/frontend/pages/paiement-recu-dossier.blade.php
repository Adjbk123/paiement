<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dossier de paiement</title>
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
.recu-badge { display: inline-block; background: #1e3a8a; color: #fff; font-size: 11px; font-weight: bold; letter-spacing: 2px; padding: 6px 14px; border-radius: 20px; text-transform: uppercase; }
.recu-ref { font-size: 11px; color: #94a3b8; margin-top: 5px; font-family: monospace; }
.status-banner { margin: 18px 32px 0; padding: 10px 18px; border-radius: 6px; }
.status-solde  { background: #f0fdf4; border-left: 4px solid #16a34a; }
.status-partiel { background: #fffbeb; border-left: 4px solid #d97706; }
.status-label-solde  { font-weight: bold; font-size: 13px; color: #15803d; }
.status-label-partiel { font-weight: bold; font-size: 13px; color: #b45309; }
.body-wrap { padding: 22px 32px; }
.section-title { font-size: 10px; font-weight: bold; color: #1e3a8a; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; padding-bottom: 4px; border-bottom: 1px solid #e2e8f0; }
.info-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; }
.info-table td { padding: 8px 10px; font-size: 12.5px; border-bottom: 1px solid #f1f5f9; }
.info-table td.label { color: #64748b; font-weight: bold; width: 38%; background: #f8fafc; }
.info-table td.value { color: #1e293b; }
.summary-hero { background: linear-gradient(135deg, #1e3a8a, #2563eb); border-radius: 10px; padding: 20px 24px; margin-bottom: 22px; }
.summary-table { width: 100%; }
.sh-cell { vertical-align: top; }
.sh-label { color: rgba(255,255,255,.7); font-size: 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
.sh-value { color: #fff; font-size: 22px; font-weight: bold; margin-top: 3px; }
.sh-sub { color: rgba(255,255,255,.65); font-size: 11px; margin-top: 2px; }
.sh-right { text-align: right; vertical-align: top; }
.tag { display: inline-block; background: rgba(255,255,255,.15); border-radius: 6px; padding: 6px 12px; }
.tag-label { color: rgba(255,255,255,.7); font-size: 10px; font-weight: bold; text-transform: uppercase; }
.tag-value { color: #fff; font-size: 12px; font-weight: bold; margin-top: 2px; }
.progress-wrap { margin-bottom: 22px; }
.progress-meta { width: 100%; margin-bottom: 5px; }
.progress-meta td { font-size: 11px; }
.pm-left { color: #64748b; }
.pm-right { text-align: right; color: #1e3a8a; font-weight: bold; }
.progress-bg { background: #e2e8f0; border-radius: 10px; height: 8px; width: 100%; }
.progress-fill { background: #1e3a8a; border-radius: 10px; height: 8px; }
.progress-amounts { width: 100%; margin-top: 5px; }
.pa-left { font-size: 11px; color: #16a34a; font-weight: bold; }
.pa-right { text-align: right; font-size: 11px; color: #dc2626; font-weight: bold; }
.tranches-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; }
.tranches-table thead th { background: #f8fafc; padding: 8px 10px; font-size: 11px; font-weight: bold; color: #64748b; text-transform: uppercase; letter-spacing: .5px; border-bottom: 2px solid #e2e8f0; }
.tranches-table tbody td { padding: 9px 10px; font-size: 12.5px; border-bottom: 1px solid #f1f5f9; }
.tranches-table tbody tr:last-child td { border-bottom: none; }
.total-row td { font-weight: bold; background: #f0fdf4; color: #15803d; border-top: 2px solid #e2e8f0; }
.footer-wrap { margin: 0 32px; padding: 14px 0 20px; border-top: 1px solid #e2e8f0; font-size: 10.5px; color: #64748b; line-height: 1.6; }
.footer-bottom { background: #f8fafc; padding: 8px 32px; font-size: 10px; color: #94a3b8; text-align: center; }
.bottom-bar { background: #1e3a8a; height: 4px; }
</style>
</head>
<body>

@php
$logo     = !empty($parametres?->photo) && file_exists(public_path('uploads/'.$parametres->photo))
            ? public_path('uploads/'.$parametres->photo)
            : public_path('uploads/default.png');
$siteName = $parametres?->website_name ?? 'MAFLYT SARL';
$phone    = $parametres?->phone1 ?? '';
$phone2   = $parametres?->phone2 ?? '';
$email    = $parametres?->email1 ?? '';
$address  = $parametres?->address ?? '';
$estSolde = $paiement->estPaye();

$totalFmt = number_format($paiement->montantTotal(), 0, ',', ' ');
$payeFmt  = number_format($paiement->totalPaye(), 0, ',', ' ');
$resteFmt = number_format($paiement->resteAPayer(), 0, ',', ' ');
$pct      = $paiement->montantTotal() > 0
            ? round($paiement->totalPaye() / $paiement->montantTotal() * 100)
            : 0;
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
                <div class="recu-badge">Dossier de paiement</div>
                <div class="recu-ref">{{ $paiement->token }}</div>
                <div class="recu-ref">Généré le {{ now()->format('d/m/Y à H:i') }}</div>
            </td>
        </tr>
    </table>
</div>

<!-- STATUT BANNER -->
<div class="status-banner {{ $estSolde ? 'status-solde' : 'status-partiel' }}">
    <span class="{{ $estSolde ? 'status-label-solde' : 'status-label-partiel' }}">
        {{ $estSolde ? '✔ Dossier entièrement soldé' : '⏳ Paiement en cours — solde restant : ' . $resteFmt . ' FCFA' }}
    </span>
</div>

<div class="body-wrap">

    <!-- RÉSUMÉ FINANCIER HERO -->
    <div class="summary-hero">
        <table class="summary-table">
            <tr>
                <td class="sh-cell">
                    <div class="sh-label">Total formation</div>
                    <div class="sh-value">{{ $totalFmt }} FCFA</div>
                    <div class="sh-sub">{{ $paiement->option->nom ?? 'N/A' }}</div>
                </td>
                <td class="sh-cell" style="text-align:center;vertical-align:top;">
                    <div class="sh-label">Total versé</div>
                    <div class="sh-value" style="color:#86efac;">{{ $payeFmt }} FCFA</div>
                    <div class="sh-sub">{{ $pct }}% réglé</div>
                </td>
                <td class="sh-right">
                    <div class="tag">
                        <div class="tag-label">Code de suivi</div>
                        <div class="tag-value">{{ $paiement->token }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- PROGRESSION -->
    <div class="section-title">Progression du paiement</div>
    <div class="progress-wrap">
        <table class="progress-meta">
            <tr>
                <td class="pm-left">{{ $payeFmt }} FCFA versés sur {{ $totalFmt }} FCFA</td>
                <td class="pm-right">{{ $pct }}%</td>
            </tr>
        </table>
        <div class="progress-bg">
            <div class="progress-fill" style="width:{{ $pct }}%;"></div>
        </div>
        <table class="progress-amounts">
            <tr>
                <td class="pa-left">Payé : {{ $payeFmt }} FCFA</td>
                @if(!$estSolde)<td class="pa-right">Reste : {{ $resteFmt }} FCFA</td>@endif
            </tr>
        </table>
    </div>

    <!-- INFOS CLIENT -->
    <div class="section-title">Informations du bénéficiaire</div>
    <table class="info-table">
        <tr><td class="label">Nom complet</td><td class="value">{{ $paiement->prenoms }} {{ $paiement->nom }}</td></tr>
        <tr><td class="label">Email</td><td class="value">{{ $paiement->email }}</td></tr>
        <tr><td class="label">Téléphone</td><td class="value">{{ $paiement->phone }}</td></tr>
        <tr><td class="label">Formation</td><td class="value">{{ $paiement->option->nom ?? 'N/A' }}</td></tr>
        <tr><td class="label">Code de suivi</td><td class="value" style="font-family:monospace;font-weight:bold;color:#1e3a8a;letter-spacing:2px;">{{ $paiement->token }}</td></tr>
    </table>

    <!-- HISTORIQUE VERSEMENTS -->
    @if($paiement->tranches->isNotEmpty())
    <div class="section-title">Historique des versements</div>
    <table class="tranches-table">
        <thead>
            <tr>
                <th style="width:30%;">Date &amp; heure</th>
                <th>Référence</th>
                <th style="text-align:right;">Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paiement->tranches as $t)
            <tr>
                <td>{{ $t->created_at->format('d/m/Y à H:i') }}</td>
                <td style="font-family:monospace;font-size:11px;">{{ $t->reference }}</td>
                <td style="text-align:right;font-weight:bold;color:#16a34a;">{{ number_format($t->montant_tranche, 0, ',', ' ') }} FCFA</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="2">Total versé</td>
                <td style="text-align:right;">{{ $payeFmt }} FCFA</td>
            </tr>
        </tbody>
    </table>
    @endif

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
