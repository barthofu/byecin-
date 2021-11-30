# byecine
Projet pour s'initier au PHP objet en MVC. 

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
- Une seule instance de connexion à la base de donnée est créée au moment de l'initialisation du [init.php](src/init.php), qui sera ensuite assignée à *l'attribut statique* **$_db** de la classe [Model.php](src/core/Model.php) 
- Nous avons décidé de rassembler les fonctionnalités DTO et DAO de la partie model dans une seule et même classe

## Structure du dossier

```bash
bycine 
├── .htaccess # redirige toutes les requêtes vers public/index.php
├── public # dossier public, accessible à l'utilisateur 
│   ├─ index.php # 
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

## Todo

- [x] système de votes
- [x] ajout / suppression de films
- [x] form du film :
    - [x] attribuer acteur
    - [x] upload de fichier
- [x] form acteur :
    - [x] attribuer films
- [x] ajout de roles aux users
- [x] page spéciale pour la modification de film
- [x] bouton pour se login
- [x] mettre en forme les forms (login/register/add film et acteur)
- [x] notif de succès d'ajout (c/c celle de l'ancien projet)
- [x] styliser le bouton d'envoie du formulaire d'ajout
- [x] suppression de l'affiche dans le dossier lorsqu'on supprime un film
- [x] page d'erreur ou redirection lorsque l'on get un film/acteur qui n'existe pas

### Optionnel 

- [x] Rendre la liste des acteurs/films sur les pages /get cliquables et redirigeant vers sa page
- [x] Interface de modification des films