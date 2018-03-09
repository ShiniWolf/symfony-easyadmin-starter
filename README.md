Symfony EasyAdmin Starter
========================


Installation
--------------

  * `composer create-project shiniwolf/symfony-easyadmin-starter project_name`

  * `php bin/console assets:install`

  * `php bin/console doctrine:database:create`

  * `php bin/console doctrine:schema:update --force`

  * `php bin/console doctrine:fixtures:load`


Fixtures
--------------

  * User :
    * Username : admin / Password : admin


What's inside?
--------------

The Symfony Standard Edition comes pre-configured with the following bundles:

  * [**StofDoctrineExtensionsBundle**][1] - Adds doctrine extension

  * [**EasyAdminBundle**][2] - Adds easyadmin routes

  * [**VichUploaderBundle**][3] - Adds file uploader

  * [**DoctrineFixturesBundle**][4] (in dev env) - Adds user fixtures


Enjoy!

[1]:  https://symfony.com/doc/master/bundles/StofDoctrineExtensionsBundle/index.html
[2]:  https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html
[3]:  https://github.com/dustin10/VichUploaderBundle
[4]:  https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html
