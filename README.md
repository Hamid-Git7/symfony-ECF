# ECF

Ce repo contient une application de gestion d'emprunt de livres. Il s'agit d'un ECF Back-End pour la validation du titre pro.

## Pré-requis

- Linux, MacOS et windows
- Bash
- PHP 8
- Composer
- Symfony-cli
- MariaDB 10

## installation

```
git clone https://github.com/Hamid-Git7/symfony-ECF
cd symfony-ECF
composer install
```

Créez une base de données et un utilisateur dédié pour cette base de données.

## Configuration

Créez un fichier `.env` à la racine du projet :

```
APP_ENV=dev
APP_DEBUG=true
APP_SECRET=123
DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"
```
Pensez à changer la variable `APP_SECRET` et le mot de passe `123` dans la variable `DATABASE_URL` .

**ATTENTION : `APP_SECRET` doit être une chaîne de caractère de 32 caractères en hexadécimal.**

## Migration et fixtures 

Créer le fichier dofilo dans le dossier bin et le rendre excutable avec la commande :
```
bin/dofilo.sh
$sudo chmod +x ./nom_du_fichier
```
Ensuite , copier dans le fichier dofilo les 4 lignes de code :
```
php bin/console doctrine:database:drop --force --if-exists
php bin/console doctrine:database:create --no-interaction
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures:load --no-interaction --group=test
```

Pour que l'application soit utilisable, vous devez créez le shéma de base de données et charger les données :


Pour que l'application soit utilisable, vous devez créer le schéma de base de données et charger les données :

```
bin/dofilo.sh
```

## Utilisation

Lancez le serveur web de developpement :

```
symfony serve
```

Puis ouvrez la page suivante : [https://localhist:8000](https://localhost:8000)

![mon image]()