# Mettre Scribe IA en ligne sur Hostinger (depuis un téléphone)

Formule visée : hébergement **mutualisé** Hostinger (Premium ou Business). Tout se fait dans le navigateur du téléphone (hPanel). Conseil : activez « Version pour ordinateur » dans votre navigateur, hPanel sera plus lisible.

> Important : Hostinger n'a pas Node.js ici. C'est normal, les fichiers CSS/JS sont déjà compilés dans `public/build` et enregistrés dans Git.

## 1. Choisir PHP 8.3 ou plus
hPanel → **Sites web** → votre site → **Avancé → Configuration PHP** → version **8.3** (ou plus récente). Dans *Extensions PHP*, vérifiez que `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `fileinfo` sont cochées.

## 2. Créer la base MySQL
hPanel → **Bases de données → Gestion** → *Créer une base de données MySQL*. Choisissez un nom, un utilisateur et un mot de passe solide. **Notez les trois** (le nom complet commence en général par `u123456789_`). L'adresse du serveur (`DB_HOST`) est `localhost`.

## 3. Déployer depuis Git
hPanel → **Avancé → Git** :
1. *Dépôt* : l'adresse du dépôt GitHub (`https://github.com/ahiankonoujoseph102-wq/scribe-ia.git`). Si le dépôt est privé, ajoutez la **clé SSH** affichée par Hostinger dans GitHub (Settings → Deploy keys) et utilisez l'adresse `git@github.com:ahiankonoujoseph102-wq/scribe-ia.git`.
2. *Branche* : `main`.
3. *Dossier d'installation* : indiquez `scribe-ia`. Le projet sera copié dans `domains/votre-domaine/public_html/scribe-ia`.
4. Cliquez **Créer**, puis **Déployer**.
5. Activez le **déploiement automatique** (webhook) : à chaque mise à jour sur GitHub, le site se met à jour.

## 4. Installer les dépendances PHP (dossier `vendor`)
Le dossier `vendor` n'est pas dans Git (trop lourd). Il faut l'installer une fois :
hPanel → **Avancé → Accès SSH** → activez-le, puis cliquez **Terminal du navigateur** (disponible aussi sur téléphone). Tapez :

```
cd domains/votre-domaine/public_html/scribe-ia
composer install --no-dev --optimize-autoloader
```

(Si `composer` n'est pas reconnu : `php composer.phar install ...` après avoir téléchargé composer avec `curl -sS https://getcomposer.org/installer | php`.)
**À refaire** seulement quand Claude vous prévient que de nouvelles dépendances ont été ajoutées.

> Si le Terminal est indisponible sur votre formule, dites-le à Claude : il pourra enregistrer `vendor` dans Git en solution de secours.

## 5. Créer le fichier .env
Toujours dans le terminal :

```
cp .env.example .env
php artisan key:generate --force
```

Puis ouvrez le **Gestionnaire de fichiers** (hPanel → Fichiers), dossier `public_html/scribe-ia`, affichez les fichiers cachés, modifiez `.env` et renseignez :

```
APP_URL=https://votre-domaine.com
DB_DATABASE=nom_de_la_base
DB_USERNAME=utilisateur
DB_PASSWORD=mot_de_passe
```

Laissez `APP_ENV=production` et `APP_DEBUG=false`. **Ne partagez jamais ce fichier** et ne le mettez jamais dans Git. Puis, dans le terminal :

```
php artisan migrate --force
chmod -R 775 storage bootstrap/cache
```

## 6. Faire pointer le domaine vers le dossier `public`
Laravel ne doit être visible que par son dossier `public`. Deux solutions :

**Solution A (recommandée)** : hPanel → **Sites web → Domaines**/**Avancé** → modifiez la *racine du document* du domaine pour qu'elle soit `scribe-ia/public` (chemin : `public_html/scribe-ia/public`).

**Solution B** (si A n'est pas possible) : demandez à Claude, il ajoutera un fichier `.htaccess` qui redirige vers `public`.

## 7. Activer le HTTPS
hPanel → **Sécurité → SSL** : installez le certificat gratuit. Le HTTPS est **obligatoire** pour que l'application s'installe sur téléphone.

## 8. Vérifier
Ouvrez `https://votre-domaine.com` : la page Scribe IA s'affiche. Sur Android (Chrome) : menu ⋮ → **Installer l'application** (ou *Ajouter à l'écran d'accueil*).

## Mises à jour ensuite
Quand du nouveau code est poussé sur `main`, le déploiement automatique le met en ligne. Si besoin, hPanel → Git → **Déployer** manuellement. Après une mise à jour qui change la base : terminal → `php artisan migrate --force`.

## En cas de problème
- Page blanche ou « 500 » : vérifier que `.env` existe et que `APP_KEY` n'est pas vide ; vérifier `chmod -R 775 storage bootstrap/cache`. Regarder `storage/logs/laravel.log`.
- Page sans mise en forme : vérifier que `public/build` est bien présent sur le serveur.
- Envoyez-moi (Claude) le message d'erreur sans les mots de passe.
