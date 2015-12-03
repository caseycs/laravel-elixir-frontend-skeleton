# laravel-elixir-frontend-skeleton

How to develop front-end for Laravel-based application, when back-end is not ready,
but you still watch to use twig layouts, macros, includes and also js and css pre-processing? 

Just few steps:

* clone this repository
* create a repository for your project and add it as remote
* install Homebrew: http://brew.sh/
* install some packages: `brew install php56 composer nodejs`
* install php dependencies: `composer install`
* install node dependencies: `npm install`
* run php server: `php -S localhost:9000 -t public/ index.php`
* run gulp: `gulp watch`
* open `http://localhost:9000`

## What's next?

Twig templates: `app/resources`.

Data for templates: `data`, `data/global.js` is included for all the pages.

CSS: `resources/assets/css`

JS: `resources/assets/js`

Start developing!
