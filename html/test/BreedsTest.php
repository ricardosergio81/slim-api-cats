<?php

use Slim\Http\Environment;
use Slim\Http\Request;


class BreedTest extends \PHPUnit\Framework\TestCase
{
    protected $app;

    public function setUp()
    {
     
$settings = require __DIR__ . '/../src/settings.php';
   $this->app = new \Slim\App($settings);

    }

    public function testBreedsGet404() {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/',
            ]);
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);
        $this->assertSame($response->getStatusCode(), 404);
        #$this->assertSame((string)$response->getBody(), "Hello, Todo");
    }

    public function testBreedsGet200() {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => 'breeds?name=Abyssinian',
            ]);

        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);
        $this->assertSame($response->getStatusCode(), 200);
        #$this->assertSame((string)$response->getBody(), "Hello, Todo");
    }

}