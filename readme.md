Sportisimo test project
=================

This is a base of project contains components like:
- Webpack (CSS/SASS/SCSS, JS)
- Nette 3 framework
- modules (Front, Admin)
- Docker ready


Requirements
------------

- PHP 8.1 (https://php.net/)
- Composer (https://getcomposer.org/)
- NPM (https://www.npmjs.com/)
  Requirement
------------
- or Docker (https://www.docker.com/)


Development
-----------

1. `composer install`
2. Import latest sql database
3. `npm install`
4. `npm run build`

Development via Docker
-----------

1. `docker-compose --file docker-compose.yaml up -d --build`
2. Import latest sql database via `adminer.local`, credentials `sportisimo` (pass `sportisimo`)

How to use
-----------
1. Open `locahost` or `locahost/admin` for administration (locally) OR Open `sportisimo.local/` or `sportisimo.local/admin`
2. Administration credentials `admin@sportisimo.cz` (pass `admin`) OR `test@sportisimo.cz` (pass `test`)

Maintainers
----------

- Jan Kouba (kouba.jann@gmail.com)
