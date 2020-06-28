<?php

namespace rs81\Resources;

use \rs81\Models\Breeds as Breed;
use GuzzleHttp\Client;

class BreedResource
{

	public function getBreeds($name) {
		$resultBreeds = self::getBreedsFromDB($name);

        if ( ! $resultBreeds ) {
            $resultBreeds = self::getBreedsFromApi($name);
        } 
    
        return $resultBreeds;
	}

	public function getBreedsFromApi($name)
    {
        $setting = include(__DIR__ . '/../settings.php');

        $client = new Client([
            'base_uri' => $setting['apiCat']['url'],
            'timeout' => 5.0,
        ]);

        $breedsResponse = $client->request('GET', 'breeds/search', [
            'query' => [ 'q' => $name ],
            'headers' => ['x-api-key' => $setting['apiCat']['apiKey']]
        ])->getBody();

        self::doBreedsInsertDB($name,  $breedsResponse);

        return  $breedsResponse;
    }

    public function doBreedsInsertDB($name, $data) {
        $breed = new Breed();
        $breed->query = $name;
        $breed->result = $data;
        $breed->save();
    }

    public function getBreedsFromDB($name)
    {
        $result = Breed::where('query', '=', $name);
        if ($result->count() > 0) {
             return $result->get()[0]->result;
        }
        return false;
    }
}