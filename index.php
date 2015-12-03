<?php
//for built-in php server
if (is_file(__DIR__ . '/public' . $_SERVER['REQUEST_URI'])) {
    return false;
}

use App\MicroKernel;
use Symfony\Component\HttpFoundation\Request;

require 'vendor/autoload.php';

$app = new MicroKernel('dev', true);
$app->loadClassCache();

$app->handle(Request::createFromGlobals())->send();
