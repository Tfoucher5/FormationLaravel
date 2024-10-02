<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FormationLaravel - README</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #007bff;
        }
        code {
            background-color: #e8e8e8;
            padding: 2px 4px;
            border-radius: 4px;
        }
        pre {
            background-color: #e8e8e8;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        ul {
            list-style-type: square;
            padding-left: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>FormationLaravel</h1>
        <p>Ce projet est une application web développée avec Laravel 11, mettant en œuvre plusieurs fonctionnalités comme la gestion des rôles, le suivi des absences et l'internationalisation.</p>
        
        <h2>Fonctionnalités</h2>
        <ul>
            <li><strong>Gestion des rôles :</strong> Utilisation de Bouncer pour les rôles et permissions des utilisateurs.</li>
            <li><strong>Gestion des absences :</strong> Soumission et validation des absences par un administrateur.</li>
            <li><strong>Multilingue :</strong> Prise en charge des langues française et anglaise avec basculement entre les deux.</li>
            <li><strong>Responsive :</strong> Design adaptable aux mobiles.</li>
        </ul>

        <h2>Prérequis</h2>
        <ul>
            <li>PHP 8.x</li>
            <li>Laravel 11</li>
            <li>Node.js & NPM</li>
            <li>Composer</li>
        </ul>

        <h2>Installation</h2>
        <pre><code>git clone https://github.com/Tfoucher5/FormationLaravel.git
cd FormationLaravel
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate</code></pre>

        <h2>Utilisation</h2>
        <p>Pour démarrer le serveur de développement :</p>
        <pre><code>php artisan serve</code></pre>
        <p>Pour compiler les assets :</p>
        <pre><code>npm run dev</code></pre>

        <h2>Contribution</h2>
        <p>Les contributions sont bienvenues. N'hésitez pas à soumettre des issues ou des pull requests.</p>
    </div>
</body>
</html>
