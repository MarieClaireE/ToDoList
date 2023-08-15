# ToDoList
Pour tester les nouvelles fonctionnalités de ToDoList, sélectionnez la branche `main`.

# Requirement 
   Symfony 6
   PHP 8.1
   MySQL 8
   
# CODACY 

# Diagrammes
Les diagrammes de classe et de cas d'utilisation se trouvent dans le dossier `diagrammes`.

# Documentations
Les documents `Implémentation de l'authentification.pdf` et `Audit.pdf` se trouvent dans le dossier `Documentations`.
Le document de contribution au projet se trouve en racine du projet. 

# Installation du projet 
1. Téléchager ou cloner le projet: `git clone https://github.com/MarieClaireE/ToDoList.git`.
2. Configurer votre `.env.local` à partir du `.env`
3. Ne pas oublier de configurer le fichier `doctrine.yaml` (`config/packages/doctrine.yaml`)
   La partie **when@test**  pour pouvoir accéder à votre base de données lors du lancement des tests.
4. Faire un `composer install`
5. Si vous n'avez pas encore créer de base de donnéés. Après vous êtes placés dans le répertoire du projet.
   Lancer `php bin/console doctrine:database:create`.
   Puis `php bin/console doctrine:migration:migrate`.

