<?php

// database
use Illuminate\Database\Capsule\Manager as Capsule;

$setting = include('settings.php');

$capsule = new Capsule;
$capsule->addConnection($setting['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();