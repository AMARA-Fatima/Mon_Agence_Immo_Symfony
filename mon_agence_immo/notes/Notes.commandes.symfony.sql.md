ls -al : pour vérifier si notre projet est bien instalé

symfony server:start -d : pour démarrer le serveur (navigateur connecté)

symfony server:stop : pous stopper le serveur (navigateur ne reconnait plus l'url) ou Ctrl + c

symfony console : permet de voir les arguments disponibles de la console presente dans le projet

php bin/console : permet de faire la même chose

http://127.0.0.1:8001/home (dans l'URL du navigateur)

composer require make : installe automatiquement un package  dans notre projet et éxecute aussi les recettes liées à ce package
(Ce bundle est visible dans bundles.php)

composer require annotation : ce bundle permet de configurer vos contrôleurs avec des annotations (Ce bundle est visible dans bundles.php)

symfony console make:controller permet de créer un controller 

Choose a name for your controller class (e.g. GentlePopsicleController):
 > home (le nom du controller crée)

symfony console debug:route (Permet de debugger nos routes et voir les erreurs sur le terminal)

composer require twig : Permet d'installer la package twig dans le Templates (il crée la base base.html.twig)

composer require (ou req) orm : permet d'installer le package ORM

------------------------CREATION DE TABLE-------------------
Dans le Terminal/Cmder:
symfony console make:entity : Permet de créer une Entité

Class name of the entity to create or update (e.g. TinyChef):
 > Article (elle sera nommé Article)

Add another property? Enter the property name (or press <return> to stop adding fields):
 > createdAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > ? : Permet d'ouvrir le champs des possibilités

Main types
  * string
  * text
  * boolean
  * integer (or smallint, bigint)
  * float

Relationships / Associations
  * relation (a wizard will help you build the relation)
  * ManyToOne
  * OneToMany
  * ManyToMany
  * OneToOne

Array/Object Types
  * array (or simple_array)
  * json
  * object
  * binary
  * blob

Date/Time Types
  * datetime (or datetime_immutable)
  * datetimetz (or datetimetz_immutable)
  * date (or date_immutable)
  * time (or time_immutable)
  * dateinterval

Other Types
  * ascii_string
  * decimal
  * guid


 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:     
 >

 updated: src/Entity/Article.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >


 
  Success! 
 

 Next: When you're ready, create a migration with php bin/console make:migration
 
----------------------RELATION ENTRE TABLES-----------------
Dans le Terminal/Cmder:
symfony console make:entity

 Class name of the entity to create or update (e.g. DeliciousElephant):
 > Article (nom de la table de référence)

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > category (nom de la table à lier)

 Field type (enter ? to see all types) [string]:
 > ? (ouvrir le champs des possibilités)

Main types
  * string
  * text
  * boolean
  * integer (or smallint, bigint)
  * float

Relationships / Associations
  * relation (a wizard will help you build the relation) 
Ci-dessus le type qui permet de faire des rélations entre table
  * ManyToOne
  * OneToMany
  * ManyToMany
  * OneToOne

Array/Object Types
  * array (or simple_array)
  * json
  * object
  * binary
  * blob

Date/Time Types
  * datetime (or datetime_immutable)
  * datetimetz (or datetimetz_immutable)
  * date (or date_immutable)
  * time (or time_immutable)
  * dateinterval

Other Types
  * ascii_string
  * decimal
  * guid


 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Category

What type of relationship is this?
 ------------ -----------------------------------------------------------------------
  Type         Description
                
 ------------ -----------------------------------------------------------------------
  ManyToOne    Each Article relates to (has) one Category.

               Each Category can relate to (can have) many Article objects


  OneToMany    Each Article can relate to (can have) many Category objects.
               Each Category relates to (has) one Article



  ManyToMany   Each Article can relate to (can have) many Category objects.
               Each Category can also relate to (can also have) many Article objects  


  OneToOne     Each Article relates to (has) exactly one Category.    

               Each Category also relates to (has) exactly one Article.
 ------------ -----------------------------------------------------------------------

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToMany ( on fait bien attention au type de rélation qu'on souhaite)

 Do you want to add a new property to Category so that you can access/update Article objects from it - e.g. $category->getArticles()? (yes/no) [yes]:
 > 

 A new property will also be added to the Category class so that you can access the related Article objects from it.

 New field name inside Category [articles]:
 >

 updated: src/Entity/Article.php
 updated: src/Entity/Category.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >

--------------------------CREATION BDD------------------------

Dans .env : on va définir la bdd:
DATABASE_URL="mysql://root:@127.0.0.1:3306/blogjstore" (en décommantant et complétant la ligne ci-dessus)
Puis, dans le terminal 

symfony console doctrine:database:create (pour créer la BDD)
Created database `blogjstore` for connection named default (voici la reponse avec le nom défini dans .env)

symfony console make:migration (Permet de créer un plan du BDD en fonctions des champs des Entités)

symfony console doctrine:migrations:migrate (exécute la requête, c'est dire introduit les champs des Entités dans la BDD nouvellement crée)

-------------------------RELATION ARTICLE/USER--------------

S C:\Users\totip\OneDrive\Bureau\.symfony\jstore-api> symfony console make:entity

 Class name of the entity to create or update (e.g. BravePizza):
 > Article (la table article)

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > author (la propriété utilisée)

 Field type (enter ? to see all types) [string]:
 > relation (nous définissons une rélation)

 What class should this entity be related to?:
 > User (la table a rélier)

What type of relationship is this?
 ------------ -------------------------------------------------------------------
  Type         Description
                       
 ------------ -------------------------------------------------------------------
  ManyToOne    Each Article relates to (has) one User.     

               Each User can relate to (can have) many Article objects


  OneToMany    Each Article can relate to (can have) many User objects.
               Each User relates to (has) one Article      



  ManyToMany   Each Article can relate to (can have) many User objects.
               Each User can also relate to (can also have) many Article objects


  OneToOne     Each Article relates to (has) exactly one User.
               Each User also relates to (has) exactly one 
Article.
 ------------ -------------------------------------------------------------------

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 >  ManyToOne (la rélation choisie)

 Is the Article.author property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to User so that you can 
access/update Article objects from it - e.g. $user->getArticles()? (yes/no) [yes]:
 > yes

 A new property will also be added to the User class so that you can access the related Article objects from it.      

 New field name inside User [articles]:
 >

 Do you want to activate orphanRemoval on your relationship?
 A Article is "orphaned" when it is removed from its related User.
 e.g. $user->removeArticle($article)

 NOTE: If a Article may *change* from one User to another, 
answer "no".

 Do you want to automatically delete orphaned App\Entity\Article objects (orphanRemoval)? (yes/no) [no]:
 >

 updated: src/Entity/Article.php
 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >


 
  Success! 
 

 Next: When you're ready, create a migration with php bin/console make:migration

----------------------INSTALLATION/PACKAGE------------------
Fixtures (jeu de données) est un ensemble de données qui permet d’avoir un environnement de développement proche d’un environnement de production avec des fausses données.

Dans le Terminal/Cmder :
composer req orm-fixtures 

Nous avons maintenant besoin d'un package qui va generer des fausses données de manière aléatoire.

Dans le Terminal/Cmder:
composer require fzaninotto/faker

---------------------------PACKAGE ADMIN----------------------

Dans le terminal :

composer req admin > entrée

symfony make:admin:dashboard



----------------------------------LE CRUD---------------------------
Pour créer(creat),lire(read),Mettre à jour(Update),Supprimer(Delete)

symfony console make:admin:crud > entrée

> 0 (pour la première entité)

> entrée

>entrée

symfony console make:admin:crud > entrée

>1 (pour la deuxième entité)

> entrée

>entrée

symfony console make:admin:crud > entrée

>2 (pour la troisième entité)

> entrée

>entrée

---------------Extension à ajouter pour l'ajout d'un article----------

Dans le terminal:
symfony composer require symfony/mime

---------------Supprimer toutes les données de le BDD-------------

Dans le terminal:
symfony console d:d:d  (pour doctrine : database : drop)

symfony console d:d:d --force (pour forcer la suppréssion)

-------------------------Crer une nouvelle BDD--------------------

Dans le terminal:
symfony console d:d:c ( c pour create)

--------------------------Envoyer des Données----------------------

Dans le terminal:
symfony console d:m:m (pour doctrine : migration : migrate)
symfony console d:m:m --force (pour forcer)


----------Barre de debug en bas de la page navigateur--------------

Dans le terminal :
composer req profiler (voir page navigateur barre en bas)

--------------Installer le composer VALIDATOR------------------

Le VALIDATOR est un package qui permet d'utiliser des classes et objets de validation d'un form notament les contraintes(constraints).
Ses contraintes ont été faire dans l'Entity User sur les propriété 
-firstname, -lastname, -email et passwordConfirm dans les anotation (@Assert...)

Dans le terminal :
composer req symfony/validator

--------------------------Securisation PASSWORD------------------

DAns l'Entity User

use Symfony\Component\Validator\Constraints as Assert;

class User implements UserInterface, PasswordAuthenticatedUserInterface

ex:

/**
    * @Assert\Length(min=3, max=255)
    */
      private $firstname;

Pour le login , on va se placer dans le security.yaml et parametrer le providers en ajoutant ; 

app_user_login:
        entity:
             class: App\Entity\User
....

	provider: app_user_login

	from_login:
	        form_login:
                		login_path: security_login
                		check_path: security_login

	        logout:
                		path: security_logout
                		target: home

les etapes pour créer le projet:
1. composer create-project symfony/website-skeleton Mon_Agence => créer un projet du nom de Mon_Agence 

2. symfony console make:controller => créer un controleur 

3. symfony console make:entity  =>  créer une class

4. symfony console d:d:c => Ajouter la Bdd
    - ou symfony console doctrine:database:create


5. symfony server:start => lancer le server
6. symfony server:stop => stopper le server

7. symfony console make:migration => migration

8. symfony console doctrine:migration:migrate 
    - ou symfony console d:m:m => migration vers la bdd
9. php -S 127.0.0.1:8000 -t public => forcer le server à se connecter