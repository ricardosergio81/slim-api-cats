<?php

use Illuminate\Database\Capsule\Manager as Capsule;

//#Define database connection
$capsule = new Capsule;
$capsule->addConnection($settings['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();