# address_book

- clone the repository
  `git clone https://github.com/aimemalaika/address_book.git`
  
- install dependency 
  `composer install`
 
 - configure credential for database in .env file
 
 - run migrations
  `php bin/console doctrine:migrations:migrate`
 
 - insert datas
  `php bin/console doctrine:fixtures:load`
  
 - run server
  `php bin/console server:run`
