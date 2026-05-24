# Air Niger — Backend API

## Description

Application de gestion de compagnie aérienne.
Backend développé avec Laravel (API REST).

## Technologies utilisées

- Laravel 10
- MySQL
- Laravel Sanctum (authentification)

## Prérequis

- PHP >= 8.1
- Composer
- MySQL

## Installation

### 1. Cloner le projet

git clone https://github.com/Yaou5/compagnie-aerienne-api.git

### 2. Installer les dépendances

composer install

### 3. Copier le fichier de configuration

cp .env.example .env

### 4. Configurer la base de données dans .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=compagnie_aerienne
DB_USERNAME=root
DB_PASSWORD=

### 5. Générer la clé

php artisan key:generate

### 6. Créer les tables

php artisan migrate

### 7. Lancer le serveur

php artisan serve

## Fonctionnalités

- Authentification avec rôles (Admin/Utilisateur)
- CRUD des vols
- Recherche de vols par origine, destination et date
- Réservation aller simple et aller retour
- Gestion des réservations
- Gestion des utilisateurs (Admin)

## Comptes de test

- Admin : dupont@mail.com / 123456
