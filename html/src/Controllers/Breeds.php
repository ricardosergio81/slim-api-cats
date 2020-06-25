<?php
namespace rs81\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Breeds
{
    public function get(Request $request, Response $response, array $args)
    {
         $name = $request->getParam('name');
         $response->getBody()->write("Breeds Name, $name");

        return $response;
    }
}