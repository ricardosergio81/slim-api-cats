<?php

namespace rs81\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \rs81\Models\Breeds as Breed;
use GuzzleHttp\Client;

class Breeds
{
    public function getBreeds(Request $request, Response $response, array $args)
    {
        $name = $request->getParam('name');
        $resultBreedsFromDB = $this->getBreedsFromDB($name);

        if ($resultBreedsFromDB) {
            $breedsResponseAPI = $this->getBreedsFromApi($name);
            #echo $breedsResponse->getStatusCode();
            $response->getBody()->write($breedsResponseAPI->getStatusCode());
            #$response->getBody()->write($setting['apiCat']['url']);
            #$response->getBody()->write("Breeds Name not found");
        } else {
            $response->getBody()->write("Breeds List" . $resultBreedsFromDB->get());
        }

        return $response;
    }

    private function getBreedsFromApi($name)
    {
        $setting = include(__DIR__ . '/../settings.php');
        $client = new Client([
            'base_uri' => $setting['apiCat']['url'],
            'timeout' => 2.0,
        ]);

        $breedsResponse = $client->request('GET', 'breeds/search', [
            'query' => ['q' => $name],
            'headers' => ['x-api-key' => $setting['apiCat']['apiKey']]
        ]);

        return $breedsResponse;
    }

    private function getBreedsFromDB($name)
    {
        $result = Breed::where('query', '=', $name);
        if ($result->count() > 0) {
            return $result;
        }
        return false;
    }
}