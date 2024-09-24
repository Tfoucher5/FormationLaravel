<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle absence</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #27ae60;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #34495e;
        }
        .highlight {
            color: #e74c3c;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #7f8c8d;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Nouvelle absence signalée</h1>
        <p><strong>Salarié :</strong> <span class="highlight">{{ $user->prenom . ' ' . $user->nom}}</span></p>
        <p><strong>Motif :</strong> <span class="highlight">{{ $motif->libelle }}</span></p>
        <p><strong>Date de début :</strong> <span class="highlight">{{ $absence->date_debut }}</span></p>
        <p><strong>Date de fin :</strong> <span class="highlight">{{ $absence->date_fin }}</span></p>

        <p>Veuillez consulter cette absence pour plus de détails.</p>
        <a href="{{ route('absence.show', $absence->id) }}" class="btn">Voir l'absence</a>

        <p class="footer">Merci de vérifier les informations dès que possible.<br>L'équipe RH</p>
    </div>
</body>
</html>
