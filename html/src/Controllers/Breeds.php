<?php

namespace rs81\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use rs81\Resources\BreedResource as BreedResource;

/**
 * @OA\Get(
 *     tags={"cat"},
 *     path="/breeds?name={name}",
 *     description="Return a list of cat's breeds",
 *     security={{"bearerAuth":{}}}, 
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="Cat's name to find",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *         style="form"
 *     ),
 *     @OA\Response(response="200", description="Sucess",
 *         content={
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 @OA\Schema(
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="string"),
 *                         @OA\Property(property="name", type="string"),
 *                         @OA\Property(property="weight", type="object",
 *                             @OA\Property(property="metric", type="string"),
 *                             @OA\Property(property="imperial", type="string"),
 *                         ),
 *                         @OA\Property(property="cfa_url", type="string"),
 *                         @OA\Property(property="vetstreet_url", type="string"),
 *                         @OA\Property(property="vcahospitals_url", type="string"),
 *                         @OA\Property(property="temperament", type="string"),
 *                         @OA\Property(property="origin", type="string"),
 *                         @OA\Property(property="country_codes", type="string"),
 *                         @OA\Property(property="country_code", type="string"),
 *                         @OA\Property(property="description", type="string"),
 *                         @OA\Property(property="life_span", type="string"),
 *                         @OA\Property(property="indoor", type="integer"),
 *                         @OA\Property(property="lap", type="integer"),
 *                         @OA\Property(property="alt_names", type="string"),
 *                         @OA\Property(property="adaptability", type="integer"),
 *                         @OA\Property(property="affection_level", type="integer"),
 *                         @OA\Property(property="child_friendly", type="integer"),
 *                         @OA\Property(property="dog_friendly", type="integer"),
 *                         @OA\Property(property="energy_level", type="integer"),
 *                         @OA\Property(property="grooming", type="integer"),
 *                         @OA\Property(property="health_issues", type="integer"),
 *                         @OA\Property(property="intelligence", type="integer"),
 *                         @OA\Property(property="shedding_level", type="integer"),
 *                         @OA\Property(property="social_needs", type="integer"),
 *                         @OA\Property(property="stranger_friendly", type="integer"),
 *                         @OA\Property(property="vocalisation", type="integer"),
 *                         @OA\Property(property="experimental", type="integer"),
 *                         @OA\Property(property="hairless", type="integer"),
 *                         @OA\Property(property="natural", type="integer"),
 *                         @OA\Property(property="rare", type="integer"),
 *                         @OA\Property(property="rex", type="integer"),
 *                         @OA\Property(property="suppressed_tail", type="integer"),
 *                         @OA\Property(property="short_legs", type="integer"),
 *                         @OA\Property(property="wikipedia_url", type="string"),
 *                         @OA\Property(property="hypoallergenic", type="integer"),
 *                     )
 *                 )
 *            )
 *        }
 *     ),
 *     @OA\Response(response="400", description="Bad Request"),
 *     @OA\Response(response="401", description="Unauthorized"),
 *     @OA\Response(response="500", description="Internal Error")
 * )
 */
class Breeds
{
    public function index(Request $request, Response $response, array $args)
    {
        try{
            $name = $request->getParam('name');
            
            if (  $name == "" ) {
    			return $response->withStatus(400);
            } else {
    	        $resultBreeds = BreedResource::getBreeds($name);

    	        $response->getBody()
    	        	->write($resultBreeds);
    		}

            return $response->withHeader("Content-Type","application/json");
        }  catch (\Illuminate\Database\QueryException | \GuzzleHttp\Exception\ConnectException $ex) {
            return $response->withStatus(500);
        }
    }
}