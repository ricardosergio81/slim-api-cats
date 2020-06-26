<?php
use rs81\Controllers as Controllers ;

$app->get('/breeds', Controllers\Breeds::class.':getBreeds');
