# address_book

- clone the repository

  `git clone https://github.com/aimemalaika/address_book.git`
  
- install dependency 

  `composer install`
 
 - configure credential for database in .env file & create database

  DATABASE_URL="mysql://`db_username`:`db_password`@127.0.0.1:3306/`db_name`?`server_version`"

  `php bin/console doctrine:database:create`
 
 - run migrations

  `php bin/console doctrine:migrations:migrate`
 
 - insert datas

  `php bin/console doctrine:fixtures:load`
  
 - run server

  `php bin/console server:run`

- App Logins

  username = `aimemalaika`
  password = `Aime1995@`

