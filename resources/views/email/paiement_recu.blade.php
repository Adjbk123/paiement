<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Reçu de paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            max-height: 80px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            color: #007bff;
        }

        .content {
            margin-bottom: 30px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content th,
        .content td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .footer {
            text-align: left;
            font-size: 11px;
            color: #555;
            line-height: 1.5;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 25px;
        }

        .status-approved {
            color: green;
            font-weight: bold;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }

        .status-failed {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
@php
    $logo = $parametres?->photo ? asset('uploads/' . $parametres->photo) : asset('uploads/default.png');
    $siteName = $parametres?->website_name ?? 'MAFLYT SARL';
@endphp

        {{-- HEADER --}}
        <div class="header">
            <img src="{{ $logo }}" alt="Logo">
            <h2>{{ $siteName }}</h2>
            <p>Reçu de paiement</p>
        </div>

        {{-- CONTENT --}}
        <div class="content">
            <table>
                <tr>
                    <th>Transaction</th>
                    <td>{{ $paiement->transaction_id ?? 'Non disponible' }}</td>
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
                    <th>Option choisie</th>
                    <td>{{ $paiement->option->nom ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Enseignement</th>
                    <td>{{ $paiement->enseignement->nom ?? $paiement->autre_enseignement }}</td>
                </tr>
                <tr>
                    <th>Montant payé</th>
                    <td>{{ number_format($paiement->montant, 0, ',', ' ') }} XOF</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td class="status-{{ $paiement->status }}">{{ ucfirst($paiement->status) }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>

        {{-- FOOTER --}}
        <div class="footer">
            <p><strong>* Pour toute réclamation, plainte ou suggestion</strong>, veuillez contacter <strong>{{ $siteName }}</strong> au <strong>{{ $parametres->phone1 }}</strong> ou par email au <strong>{{ $parametres->email1 }}</strong>.</p>
            <p>Si vous n'avez pas satisfaction, contactez l'équipe <strong>FedaPay</strong> au <strong>+229 63 95 43 13</strong> / <strong>+229 99 45 11 11</strong>, ou envoyez un email à <strong>support@fedapay.com</strong> ou écrivez sur le tchat du site <strong>www.fedapay.com</strong>.</p>
            <p>{{ $siteName }} © {{ date('Y') }} | Adresse : {{ $parametres->address }}</p>
        </div>

    </div>
</body>

</html>
