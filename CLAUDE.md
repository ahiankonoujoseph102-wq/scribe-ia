# Scribe IA — mémoire du projet

## Le propriétaire
Joseph. Il travaille **uniquement depuis son téléphone, sans ordinateur** : il ne peut lancer aucune commande. Toujours lui expliquer les choses **simplement, en français, sans jargon inutile**.

## Le projet
Scribe IA est une application web installable sur téléphone (PWA), **en français**, pour les formateurs d'Afrique francophone.

Étapes prévues, dans cet ordre (ne jamais anticiper l'étape suivante sans demande) :
1. Comptes utilisateurs, transcription d'un fichier audio/vidéo importé, résumé, dictée vocale, dictaphone avec indicateur d'enregistrement visible, export Word et PDF.
2. Transcription d'une vidéo à partir d'un lien ; test de la langue éwé.
3. Robot qui rejoint une réunion Google Meet, l'enregistre et produit enregistrement, transcription et rapport PDF.
4. Abonnements avec quotas mensuels en heures (Gratuit, Essentiel 10 000 FCFA, Pro 20 000, Business 30 000), paiement Mobile Money, espace administrateur.

## Budget
**35 000 FCFA par an au total**, uniquement pour l'hébergement. Ne jamais proposer un service payant supplémentaire sans prévenir Joseph et sans proposer une solution gratuite.

## Choix techniques (non négociables)
- Laravel (dernière version stable), PHP, vues Blade, Tailwind CSS (v4 via Vite).
- Base de données : MySQL en production. Pour les tests locaux : SQLite.
- Hébergement : Hostinger, formule mutualisée, déploiement par Git depuis ce dépôt.
- **Pas de Node.js sur l'hébergement** : le dossier `public/build` (CSS/JS compilés) est **enregistré dans Git**. Après toute modification de `resources/css` ou `resources/js` ou des vues Blade (classes Tailwind), lancer `npm run build` et committer `public/build`.
- Transcription : Whisper via Groq (à brancher plus tard). Résumés : Gemini (à brancher plus tard).
- Le robot Google Meet et le téléchargement par lien tourneront plus tard sur un serveur séparé (hors périmètre pour l'instant).

## Règles
- Aucune clé secrète ni mot de passe dans le code. `.env` n'est jamais commité ; `.env.example` ne contient que des noms de variables.
- Interface entièrement en français, pensée d'abord pour le téléphone.
- Pas de polices ou scripts chargés depuis un CDN externe (polices système).
- Branche de travail : celle indiquée par la session ; ne pas créer de pull request sans demande.

## Commandes utiles (environnement de développement)
- `composer install`, `cp .env.example .env`, `php artisan key:generate`
- `npm install && npm run build`
- `php artisan serve` puis tester ; `php artisan test`

## État actuel
Étape 0 terminée : Laravel installé, PWA (manifest, service worker minimal, icônes provisoires dans `public/icons`), page d'accueil avec 5 cartes « Bientôt disponible », `DEPLOIEMENT.md`.
