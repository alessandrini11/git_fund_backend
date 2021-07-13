GIT FUND
after cloning the repository
run the following commands to get set
******************************************
php bin/console doctrine:database:create
******************************************
php bin/console make:migration
********************************************
php bin/console doctrine:migration:migrate 
********************************************
php bin/console doctrine:fixtures:load
*********************************************
start the server 
