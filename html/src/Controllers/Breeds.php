<?php
namespace rs81\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \rs81\Models\Breeds as Breed;
use GuzzleHttp\Client;

class Breeds
{
    public function get(Request $request, Response $response, array $args)
    {
        $setting = include(__DIR__.'/../settings.php');

        $name = $request->getParam('name');

        $result = Breed::where('query', '=', $name);

        if ( $result->count() == 0 ) {
        $client = new Client([
            'base_uri' => $setting['apiCat']['url'],
            'timeout'  => 2.0,
        ]);

        $breedsResponse = $client->request('GET', 'breeds/search',[
                    'query' => ['q' => $name],
                    'headers'=> ['x-api-key' => $setting['apiCat']['apiKey']]
        ]);
        #echo $breedsResponse->getStatusCode();
        $response->getBody()->write( $breedsResponse->getStatusCode());
        #$response->getBody()->write($setting['apiCat']['url']);
        #    $response->getBody()->write("Breeds Name not found");
        } else {
            $response->getBody()->write("Breeds List"  .$result->get());
        }

        return $response;
    }
}