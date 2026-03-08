{{-- resources/views/frontend/pages/paiement-success.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut du Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 650px;
            margin: 60px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .icon {
            font-size: 60px;
            margin-bottom: 10px;
        }

        .success {
            color: #16a34a;
        }

        .cancel {
            color: #dc2626;
        }

        .pending {
            color: #f59e0b;
        }

        .header h1 {
            margin: 5px 0;
        }

        .subtitle {
            color: #666;
            font-size: 14px;
        }

        .info {
            margin-top: 25px;
        }

        .info table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .info th {
            padding: 10px;
            text-align: left;
            background: #f8fafc;
            border-bottom: 1px solid #eee;
            width: 40%;
        }

        .info td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .amount {
            font-weight: bold;
            color: #16a34a;
        }

        .buttons {
            text-align: center;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 11px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin: 5px;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-success {
            background: #16a34a;
            color: #fff;
        }

        .btn-success:hover {
            background: #15803d;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 25px;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- ================= HEADER ================= --}}
        <div class="header">
            @if ($paiement->status === 'approved')
                <div class="icon success">✔</div>
                <h1>Paiement réussi</h1>
                <p class="subtitle">Merci <strong>{{ $paiement->prenoms }} {{ $paiement->nom }}</strong> pour votre
                    paiement</p>
            @elseif($paiement->status === 'canceled')
                <div class="icon cancel">✖</div>
                <h1>Paiement annulé</h1>
                <p class="subtitle">Le paiement n'a pas été effectué</p>
            @else
                <div class="icon pending">⏳</div>
                <h1>Paiement en attente</h1>
                <p class="subtitle">Votre paiement est en cours de traitement</p>
            @endif
        </div>

        {{-- ================= INFORMATIONS ================= --}}
        <div class="info">
            <table>
                <tr>
                    <th>Référence</th>
                    <td>{{ $paiement->reference }}</td>
                </tr>
                <tr>
                    <th>Montant payé</th>
                    <td class="amount">{{ number_format($paiement->montant, 0, ',', ' ') }} XOF</td>
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
                    <th>Email</th>
                    <td>{{ $paiement->email }}</td>
                </tr>
            </table>
        </div>

        {{-- ================= BOUTONS ================= --}}
        <div class="buttons">
            {{-- Télécharger le reçu uniquement si paiement approuvé --}}
            @if ($paiement->status == 'approved')
                <a href="{{ route('paiement.download', $paiement->id) }}" class="btn btn-success">
                    Télécharger le reçu
                </a>
            @endif

            <a href="{{ url('/paiement') }}" class="btn btn-primary">
                Retour au paiement
            </a>
        </div>

        {{-- ================= FOOTER ================= --}}
        <div class="footer">
            Votre reçu officiel peut être conservé pour vos archives.
        </div>

    </div>

</body>

</html>
