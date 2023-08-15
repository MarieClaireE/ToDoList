# ToDoList

Pour tester les nouvelles fonctionnalités de ToDoList, sélectionnez la branche `main`.

# CODACY 

# Diagrammes

# Documentations

# Installation du projet 
1. Téléchager ou cloner le projet: `git clone https://github.com/MarieClaireE/ToDoList.git`.
2. Configurer votre `.env.local` à partir du `.env`
3. Ne pas oublier de configurer le fichier `doctrine.yaml` (`config/packages/doctrine.yaml`)
   La partie **when@test**  pour pouvoir accéder à votre base de données lors du lancement des tests.
4. Faire un `composer install`
5. Si vous n'avez pas encore créer de base de donnéés. Après vous êtes placés dans le répertoire du projet.
   Lancer `php bin/console doctrine:database:create`.
   Puis `php bin/console doctrine:migration:migrate`.

