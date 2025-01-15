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
APP_SECRET=43168aaea0a236a59a1bd62c08e5483d
# remplacer la version de MariaDB /MySQL par la votre
DATABASE_URL="mysql://login-bdd:mdp-bdd@127.0.0.1:3306/name-bdd?serverVersion=10.4.32-MariaDB&charset=utf8mb4"
# remplacer par votre clé api weather
WEATHER_API=00000000000000000000000000000000
```

3 Installer les dépendances du projet :
```sh
composer install
```

4 Créer et migrer la base de données :
```sh
symfony console d:d:c
symfony console d:m:m
```

5 Créer les fixtures :
```sh
symfony console d:f:l
```

6 Télécharger les assets :
```sh
# si manquante
symfony console importmap:require preline
# si erreur
symfony console importmap:install
```

7 Builder les sources Tailwind :
```sh
./bin/tailwindcss -i assets/styles/app.css -o assets/styles/app.tailwind.css –W
```

8 Démarrer le projet :
```sh
symfony server:start -d
# ou (Alias)
symfony serve -d
```
