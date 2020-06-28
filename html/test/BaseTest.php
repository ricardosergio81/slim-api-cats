<?php

namespace rs81\test;

use Slim\App;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\Response;
use Slim\Http\Uri;

abstract class BaseTest extends \PHPUnit\Framework\TestCase
{
    /** @var Response */
    private $response;
    /** @var App */
    private $app;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->app = require __DIR__.'/../src/app.php';
    }

    protected function request($method, $url, array $requestParameters = [])
    {
        $request = $this->prepareRequest($method, $url, $requestParameters);
        $response = new Response();

        $app = $this->app;
        $this->response = $app($request, $response);
    }

    private function prepareRequest($method, $url, array $requestParameters)
    {
        $env = Environment::mock([
            'REQUEST_URI' => $url,
            'REQUEST_METHOD' => $method
        ]);

        $parts = explode('?', $url);

        if (isset($parts[1])) {
            $env['QUERY_STRING'] = $parts[1];
        }

        $uri = Uri::createFromEnvironment($env);
        $headers = Headers::createFromEnvironment($env);
        $cookies = [];
        
        $serverParams = $env->all();

        $body = new RequestBody();
        $body->write(json_encode($requestParameters));

        $request = new Request($method, $uri, $headers, $cookies, $serverParams, $body);

        return $request->withHeader('Content-Type', 'application/json');
    }

    protected function assertThatResponseHasStatus($expectedStatus)
    {
        $this->assertEquals($expectedStatus, $this->response->getStatusCode());
    }

    protected function responseData()
    {
        return json_decode((string) $this->response->getBody(), true);
    }

}