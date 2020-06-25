<?php
require '../vendor/autoload.php';

$configuration = require "../src/configuration.php";
$app = new \Slim\App($configuration);

require "../src/routes.php";

$app->run();
