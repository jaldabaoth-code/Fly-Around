<h1>Fly Around (Services Workshop, WCS Web PHP)</h1>

### There is "Symfony Services Workshop" we did during WCS Web PHP


---

## Fly Around

### index

1. [Description](#Description)
2. [Prerequisites](#Prerequisites)
4. [Installation](#Steps)

### Description

Workshop instructions: https://github.com/jaldabaoth-code/Fly-Around/blob/main/WorkshopInstructions.pdf

### Prerequisites

* [PHP 7.4.*](https://www.php.net/releases/7_4_0.php) (check by running php -v in your console)
* [Composer 2.*](https://getcomposer.org/) (check by running composer --version in your console)
* [node 14.*](https://nodejs.org/en/) (check by running node -v in your console)
* [Yarn 1.*](https://yarnpkg.com/) (check by running yarn -v in your console)
* [MySQL 8.0.*](https://www.mysql.com/fr/) (check by running mysql --version in your console)
* [Git 2.*](https://git-scm.com/) (check by running git --version in your console)

### Steps

If you meet the prerequisites, you can proceed to the installation of the project 

1. Clone the repo from GitHub : `git clone git@github.com:jaldabaoth-code/Fly-Around.git`
2. Enter the directory : `cd Fly-Around`
3. Open with your code editor
4. Run `composer install` to install PHP dependencies
5. Run `yarn install` to install JS dependencies
6. Run `cp .env .env.local` and configure your `DATABASE_URL`
7. Run `symfony console doctrine:database:create` to create database
8. Run `symfony console doctrine:migration:migrate` to create structure of database
9. Run `symfony console doctrine:fixtures:load` to load the fixtures in database
10. Run `yarn encore dev` to build assets
11. Run `symfony server:start` to launch symfony server
12. Go to <b>localhost:8000</b> with your favorite browser

Note: Cities Data are parsed from `src/DataFixtures/worldcities_dataset.csv` file
Should you insert more cities in database, just update `const LIMIT = 20` in `src/DataFixtures/CityFixtures.php` file

---

## The Links

<a href="https://wildcodeschool.github.io/workshop-php-symfony-services/">Link to <b>The Workshop instructions</b></a>

<a href="https://github.com/WildCodeSchool/php-orleans-202103-worksop-symfony-services">Link to the repository of <b>The Symfony Services Workshop - Fly Around</b></a>
