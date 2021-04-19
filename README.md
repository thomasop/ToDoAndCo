# Todo and co

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/1e157ee5f90245c08f8e53ce525d320c)](https://www.codacy.com/gh/thomasop/ToDoAndCo/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=thomasop/ToDoAndCo&amp;utm_campaign=Badge_Grade)

[![Build Status](https://travis-ci.com/thomasop/ToDoAndCo.svg?branch=master)](https://travis-ci.com/thomasop/ToDoAndCo)

OpenClassrooms project for "PHP / Symfony" course.

The objective is to improve an existing application build with Symfony 3.1.6 and Bootstrap 3.3.7.

## How to install the project

### Prerequisite

Symfony 4.4
Bootstrap 3.3.7
PHP 7.3 or higher
Download Wamp, Xampp, Mamp or WebHost
composer

### Clone

1 - Clone or download the project

https://github.com/thomasop/ToDoAndCo.git

### Configuration

2 - Update environnements variables in the .env file with your values. At the very least you need to define the SYMFONY_ENV=prod DATABASE_URL

DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name

### Composer

3 - Install composer with composer install and init the projet with composer init in SnowTricks folder

4 - Run composer update to install dependencies

### Database

5 - Use the command php bin/console doctrine:database:create for database creation.

6 - Use the command php bin/console doctrine:migrations:migrate for creation of the tables.

7 - Use the command php bin/console doctrine:fixtures:load for load some data in database.

### Usage

Login link :

/login

An admin account is already available with ROLE_ADMIN, use it to test the application :

"username" : "test",
"password" : "Test1234?"

An user account is already available with ROLE_USER, use it to test the application :

"username" : "User",
"password" : "User"

An user admin account is already available with ROLE_USER, use it to test the application :

"username" : "UserAnon",
"password" : "UserAnon"

### Tests

1 - Update the test database identifiers in project/ .env.test and update DATABASE_URL variable

2 - Run tests

php bin/phpunit

### Contributing

To contribute see [CONTRIBUTING.md](https://github.com/thomasop/ToDoAndCo/blob/master/CONTRIBUTING.md)
