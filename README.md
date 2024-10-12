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
Clonez le projet sur votre machine dans le dossier code de Homestead : 
```bash
git clone https://github.com/Tfoucher5/FormationLaravel.git
```
Déplacez-vous dans le dossier qui à été ajouté : 
```bash
cd FormationLaravel
```
Installez les composants et npm : 
```bash
composer install
npm install
```
Copiez les paramètres de .env.example dans .env pour que tout fonctionne corectement : 
```bash
cp .env.example .env
```
Générez la clé de l'application : 
```bash
php artisan key:generate
```
Mettez en place la base de données et les données qui y seront : 
```bash
php artisan migrate
php artisan db:seed
```

Voici les identifiants pour vous connecter en tant qu'utilisateur ou en tant qu'admin : 
```bash
User :
    - Email : user@user.com
    - Password : totototo

Admin :
    - Email : theonicolas.foucher@gmail.com
    - Password : totototo
```
