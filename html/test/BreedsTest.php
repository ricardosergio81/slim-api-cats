<?php

use rs81\Controllers\Breeds as Breeds;

class BreedTest extends \PHPUnit\Framework\TestCase
{
    protected $app;

    public function testBreedsFromDBNotFound()
    {
        $method = new ReflectionMethod(Breeds::class, 'getBreeds');
        $method->setAccessible(true);
        $response = $method->invokeArgs(new Breeds, array('Mike'));
        var_dump($response);
//        $breeds = new Breeds();
//        $breeds->getBreeds()
    }

}