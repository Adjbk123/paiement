<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Reçu de paiement</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 13px; color: #1a1a2e; background: #fff; }

/* ── BANDE COULEUR TOP ── */
.top-bar { background: #1e3a8a; height: 8px; width: 100%; }

/* ── HEADER ── */
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

/* ── STATUT BANNER ── */
.status-banner { margin: 12px 32px 0; padding: 10px 18px; border-radius: 6px; }
.status-approved { background: #f0fdf4; border-left: 4px solid #16a34a; }
.status-pending  { background: #fffbeb; border-left: 4px solid #d97706; }
.status-failed   { background: #fef2f2; border-left: 4px solid #dc2626; }
.status-label { font-weight: bold; font-size: 13px; }
.status-approved .status-label { color: #15803d; }
.status-pending  .status-label { color: #b45309; }
.status-failed   .status-label { color: #b91c1c; }

/* ── BODY ── */
.body-wrap { padding: 16px 32px 22px; }

/* ── SECTION TITLE ── */
.section-title { font-size: 10px; font-weight: bold; color: #1e3a8a; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; padding-bottom: 4px; border-bottom: 1px solid #e2e8f0; }

/* ── INFO TABLE ── */
.info-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; }
.info-table td { padding: 8px 10px; font-size: 12.5px; border-bottom: 1px solid #f1f5f9; }
.info-table td.label { color: #64748b; font-weight: bold; width: 38%; background: #f8fafc; }
.info-table td.value { color: #1e293b; }

/* ── MONTANT HERO ── */
.amount-hero { background: linear-gradient(135deg, #1e3a8a, #2563eb); border-radius: 10px; padding: 20px 24px; margin-bottom: 22px; }
.amount-hero-table { width: 100%; }
.amount-label { color: rgba(255,255,255,.75); font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
.amount-value { color: #fff; font-size: 28px; font-weight: bold; margin-top: 4px; }
.amount-sub { color: rgba(255,255,255,.7); font-size: 11px; margin-top: 2px; }
.amount-right { text-align: right; vertical-align: middle; }
.amount-right-inner { display: inline-block; background: rgba(255,255,255,.15); border-radius: 8px; padding: 8px 14px; }
.amount-right-label { color: rgba(255,255,255,.75); font-size: 10px; font-weight: bold; text-transform: uppercase; }
.amount-right-value { color: #fff; font-size: 13px; font-weight: bold; margin-top: 3px; }

/* ── PROGRESS BAR ── */
.progress-wrap { margin-bottom: 22px; }
.progress-labels { width: 100%; margin-bottom: 5px; }
.progress-labels td { font-size: 11px; }
.progress-labels .p-left { color: #64748b; }
.progress-labels .p-right { text-align: right; color: #1e3a8a; font-weight: bold; }
.progress-bg { background: #e2e8f0; border-radius: 10px; height: 8px; width: 100%; }
.progress-fill { background: #1e3a8a; border-radius: 10px; height: 8px; }
.progress-amounts { width: 100%; margin-top: 5px; }
.progress-amounts .pa-left { font-size: 11px; color: #16a34a; font-weight: bold; }
.progress-amounts .pa-right { text-align: right; font-size: 11px; color: #dc2626; font-weight: bold; }

/* ── DIVIDER ── */
.divider { border: none; border-top: 1px solid #e2e8f0; margin: 20px 0; }

/* ── FOOTER ── */
.footer-wrap { margin: 0 32px; padding: 14px 0 20px; border-top: 1px solid #e2e8f0; font-size: 10.5px; color: #64748b; line-height: 1.6; }
.footer-bottom { background: #f8fafc; margin: 0; padding: 8px 32px; font-size: 10px; color: #94a3b8; text-align: center; }
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

$statusLabel = match($paiement->status) {
    'approved' => '✔ Paiement confirmé',
    'failed'   => '✘ Paiement échoué',
    default    => '⏳ En attente de confirmation',
};

$totalFmt  = number_format($paiement->montantTotal(), 0, ',', ' ');
$payeFmt   = number_format($paiement->totalPaye(), 0, ',', ' ');
$resteFmt  = number_format($paiement->resteAPayer(), 0, ',', ' ');
$pct       = $paiement->montantTotal() > 0
             ? round($paiement->totalPaye() / $paiement->montantTotal() * 100)
             : 0;
$montantFmt = number_format($paiement->montant, 0, ',', ' ');
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
                <div class="recu-badge">Reçu de paiement</div>
                <div class="recu-ref">{{ $paiement->reference }}</div>
                <div class="recu-ref">{{ $paiement->created_at->format('d/m/Y à H:i') }}</div>
            </td>
        </tr>
    </table>
</div>

<!-- STATUT BANNER -->
<div class="status-banner status-{{ $paiement->status }}">
    <span class="status-label">{{ $statusLabel }}</span>
</div>

<!-- BODY -->
<div class="body-wrap">

    <!-- MONTANT HERO -->
    <div class="amount-hero">
        <table class="amount-hero-table">
            <tr>
                <td>
                    <div class="amount-label">Montant versé</div>
                    <div class="amount-value">{{ $montantFmt }} FCFA</div>
                    <div class="amount-sub">Formation : {{ $paiement->option->nom ?? 'N/A' }}</div>
                </td>
                <td class="amount-right">
                    <div class="amount-right-inner">
                        <div class="amount-right-label">Code de suivi</div>
                        <div class="amount-right-value">{{ $paiement->token ?? '—' }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- PROGRESSION DU PAIEMENT -->
    @if($paiement->montantTotal() > 0)
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

    <!-- INFORMATIONS CLIENT -->
    <div class="section-title">Informations du bénéficiaire</div>
    <table class="info-table">
        <tr><td class="label">Nom complet</td><td class="value">{{ $paiement->prenoms }} {{ $paiement->nom }}</td></tr>
        <tr><td class="label">Email</td><td class="value">{{ $paiement->email }}</td></tr>
        <tr><td class="label">Téléphone</td><td class="value">{{ $paiement->phone }}</td></tr>
        <tr>
            <td class="label">Niveau d'enseignement</td>
            <td class="value">
                @if($paiement->enseignement){{ $paiement->enseignement->nom }}
                @else Autre : {{ $paiement->autre_enseignement }}@endif
            </td>
        </tr>
    </table>

    <!-- DÉTAIL TRANSACTION -->
    <div class="section-title">Détail de la transaction</div>
    <table class="info-table">
        <tr><td class="label">Référence</td><td class="value" style="font-family:monospace;">{{ $paiement->reference }}</td></tr>
        <tr><td class="label">ID Transaction</td><td class="value" style="font-family:monospace;">{{ $paiement->transaction_id ?? '—' }}</td></tr>
        <tr><td class="label">Date &amp; heure</td><td class="value">{{ $paiement->created_at->format('d/m/Y à H:i') }}</td></tr>
        <tr><td class="label">Statut</td><td class="value"><strong>{{ $statusLabel }}</strong></td></tr>
    </table>

</div>

<!-- FOOTER -->
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
    {{ $siteName }} © {{ date('Y') }} — Ce document est généré automatiquement et ne nécessite pas de signature.
</div>
<div class="bottom-bar"></div>

</body>
</html>
