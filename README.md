# FormationLaravel

Ce projet est une application web développée avec Laravel 11, mettant en œuvre plusieurs fonctionnalités comme la gestion des rôles, le suivi des absences et l'internationalisation.

## Fonctionnalités
- **Gestion des rôles** : Utilisation de Bouncer pour les rôles et permissions des utilisateurs.
- **Gestion des absences** : Soumission et validation des absences par un administrateur.
- **Multilingue** : Prise en charge des langues française et anglaise avec basculement entre les deux.
- **Responsive** : Design adaptable aux mobiles.

## Prérequis
- PHP 8.x
- Laravel 11
- Node.js & NPM
- Composer

## Installation
```bash
git clone https://github.com/Tfoucher5/FormationLaravel.git
cd FormationLaravel
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
