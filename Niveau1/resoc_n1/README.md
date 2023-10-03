## Objectif niveau 1

L’objectif de ce niveau est de se familiariser avec le PHP et comment il se “mélange” avec le HTML. Il permet aussi de s’habituer à se repérer dans un code pré-existant.

Dans les documents fournis (cf archive niveau1), toute la partie Sql a été faite pour vous, le document HTML/CSS est presque fini. Il est recommandé de ne pas toucher au html/css/mysql à ce niveau. Il vous reste à introduire les données de la base de donnée aux bons endroits du HTML.

Pour éviter la complexité liée à l’inscription et l’identification, on considère ici que l’identification a déjà été faite et que vous avez les privilèges d’administration et donc que vous avez accès à tous les contenus.

## Etapes

- La première étape de **configuration** est nécessairement d’importer la base de donnée:
  - Récupérer le fichier nommé “Niveau1.sql” dans l’**archive niveau 1** (Niveau1.sql est à la racine de l’archive Niveau1.zip)
  - Se connecter sur phpmyadmin (une fois lancé votre xAMP probablement à l’adresse http://localhost/phpmyadmin/ )
  - Dans l’interface proposée > onglet importer > Parcourir les fichiers : Niveau1.sql > Exécuter
  - S’assurer que la base “socialnetwork” a bien été ajouté dans la colonne de gauche. Ce fichier contient la structure et quelques données pour peupler une base de donnée cohérente.
- La seconde étape de **configuration** est nécessairement d’installer les fichiers du répertoire “pages” (le répertoire qui contient les pages s’appelle Niveau1 dans l’archive Niveau1.zip)
  - Installer les fichiers dans un sous répertoire de votre htdocs pour pouvoir y accéder par le serveur apache.
  - Pour la suite on considère que ce répertoire est appelé “resoc_n1”.
  - Pour travailler en groupe, c’est ce répertoire que vous partagerez sur Github.
- La dernière étape, le **refactoring**.
  - Vous avez noté que certaines parties du code sont répétées de nombreuses fois (la connexion à la base de données sur chaque page par exemple).
  - Vous pouvez réorganiser tout ça en mettant le code répété dans un fichier à part et en utilisant les instructions “include” du php. Cette refonte de code est classique et s’appelle du réusinage (refactoring en anglais).
  - **Conseil** - Concentrer les traitements php en début de fichier et n'utiliser ensuite que des structures simples pour juste faire du templating.
  - Pensez à faire des commits à chaque étape de cette procédure sensible.
- Dans ce niveau 1, le projet est assez avancé, la plupart des pages sont presque terminées, les commentaires contiennent toutes les instructions (repérez en particulier les mention @ todo qui désignent là où vous avez le plus à faire), pour une difficulté croissante il est recommandé de résoudre les pages dans cet ordre:
  1. news.php (probablement http://localhost/resoc_n1/news.php )
  2. admin.php (probablement http://localhost/resoc_n1/admin.php )
  3. settings.php
  4. wall.php
  5. feed.php
  6. tags.php
  7. subscriptions.php
  8. followers.php

## Ressources spécifiques au niveau 1

- Tutoriel PHP : https://www.php.net/manual/fr/tutorial.php (pour se faire une première idée)
- Archive niveau 1 Divers pointeurs vers la documentation sont indiquées dans le code

[Niveau1.zip](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/d028a2f1-8156-4976-be39-0df5229ca27c/Niveau1.zip)

Ressources utilisées :

  -> news.php

   Fonction explode()
   problème : les hashtags doivent être séparés en chacun un lien
   recherche : "separate string in php"
   ressource :

      - https://stackoverflow.com/questions/20698332/php-how-to-combine-foreach-and-explode
      - https://www.php.net/manual/en/function.explode.php


  -> admin.php

  Etape 3 :
    création d'un tableau $tag pour stocker les données extraites de la BdD
    une boucle while pour récupérer les tableaux associatifs
    on remplace les mots-clés par les valeurs récupérées dans le tableau $tag
