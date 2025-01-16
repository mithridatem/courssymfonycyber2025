# courssymfonycyber2025

Installation du projet :

1 Cloner le projet :
```bash
git clone https://github.com/mithridatem/courssymfonycyber2025.git
cd courssymfonycyber2025
```

2 Créer les fichiers d'environnement .env et .env.dev :
```sh
# .env
APP_ENV=dev
APP_SECRET=
DATABASE_URL=
MESSENGER_TRANSPORT_DSN=doctrine://default?auto_setup=0
MAILER_DSN=null://null
WEATHER_API=
```
```sh
# .env.dev
APP_SECRET=0000000000000000000000
# remplacer la version de MariaDB /MySQL par la votre
DATABASE_URL="mysql://login-bdd:mdp-bdd@127.0.0.1:3306/name-bdd?serverVersion=10.4.32-MariaDB&charset=utf8mb4"
# remplacer par votre clé api weather
WEATHER_API=00000000000000000000000000000000
```
3 Générer la clé APP_SECRET
```sh
symfony console secrets:set APP_SECRET
symfony console secrets:set APP_SECRET --local
@```

4 Installer les dépendances du projet :
```sh
composer install
```

5 Créer et migrer la base de données :
```sh
symfony console d:d:c
symfony console d:m:m
```

6 Créer les fixtures :
```sh
symfony console d:f:l
```

7 Télécharger les assets :
```sh
# si manquante
symfony console importmap:require preline
# si erreur
symfony console importmap:install
```

8 Builder les sources Tailwind :
```sh
./bin/tailwindcss -i assets/styles/app.css -o assets/styles/app.tailwind.css –W
```

9 Démarrer le projet :
```sh
symfony server:start -d
# ou (Alias)
symfony serve -d
```
