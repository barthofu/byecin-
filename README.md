# byecine
Projet pour s'initier au PHP objet en MVC, réalisé pour un TP de PHP à l'IUT. 

## Utilisation

Le site est disponible publiquement à l'adresse suivante : **[byecine.barthofu.com](https://byecine.barthofu.com)**

## Comment ça marche
Il s'agit d'une application MVC normale, composée de modèles, de vues et de contrôleurs.

1. Tout d'abord, le script d'initialisation [init.php](src/init.php) est exécuté.
    - Le script d'initiation charge les scripts principaux et les fichiers de configuration.
2. Ensuite, une nouvelle instance d'application est créée et l'url est analysée dans la classe [Router.php](src/core/Router.php) (qui fait office de "FrontController").
    - L'url est en fait destructurée en 2 parties par le Router : *https://\[host\]/[contrôleur]()/[méthode]()?[arguments]()*
3. Une instance de [contrôleur](src/controllers) est créée et la méthode demandée est appelée.
4. La méthode du contrôleur appelle récupère le modèle, parse les données, effectue toute la business logic nécessaire (même si une meilleure façon de faire serait de mettre toute la logique dans un layer supplémentaire "**services**" situé entre le contrôleur et le modèle, mais ce n'est pas forcément nécessaire pour un projet de petite envergure comme celui-ci).
5. En fonction de la page à laquelle on veut accéder, une methode [isLogged()](src/utils/session.php) sera appelée pour vérifier si l'utilisateur est connecté ainsi que son grade (user, admin, etc), et sera redirigé vers la page de login si ce n'est pas le cas.
6. Enfin, la méthode du contrôleur appelle la méthode de la vue en passant en paramètres la liste des variables dont la vue aura besoin.

#### Petites précisions
- Les URL sont ré-écrites par le .htaccess tel que : *https://\[host\]/films/add* -> *https://\[host\]/public/index.php?req=films/add*
- Le routeur est basé sur le système de fichier et l'arborescence
- Une seule instance de connexion à la base de donnée est créée au moment de l'initialisation du [init.php](src/init.php), qui sera ensuite assignée à *l'attribut statique* **$_db** de la classe [Model.php](src/core/Model.php) 
- Nous avons décidé de rassembler les fonctionnalités DTO et DAO de la partie model dans une seule et même classe

## Structure du dossier

```bash
bycine 
├── .htaccess # redirige toutes les requêtes vers public/index.php
├── public # dossier public, accessible à l'utilisateur 
│   ├─ index.php # fichier vers lequel toute requete est redirigée, et qui inclus le src/init.php
│   ├─ scripts # fichiers Javascript
│   ├─ styles # fichiers CSS
│   └─ assets # images, videos, sons, svg, etc 
└─ app
    ├─ init.php # charge toutes les classes / fonctions / variables nécessaires au bon fonctionnement de l'app
    ├─ config # variables de configuration
    ├─ controllers # contrôleurs
    ├─ core # classes (souvent mères) servant de coeur à l'application
    ├─ models # modèles
    ├─ utils # fonctions utilitaires
    └─ views # vues
        ├─ layout # éléments redondants aux pages (ex: header et footer)
        └─ templates # contenu des pages
```