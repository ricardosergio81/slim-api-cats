<?php

namespace rs81\Controllers;

use Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use rs81\Resources\LoginResource as LoginResource;

/**
 * @OA\Post(
 *     tags={"login"},
 *     path="/login",
 *     description="API authentication",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="username", description="Username", type="string"),
 *                 @OA\Property(property="password", description="Password",type="string"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(response="200", description="Sucess",
 *         content={
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 @OA\Schema(
 *                     @OA\Property(property="jwt", type="string"),
 *                 ),
 *             ),
 *         }
 *     ),
 *     @OA\Response(response="400", description="Bad Request"),
 *     @OA\Response(response="500", description="Internal Error")
 * )
 */

class Login
{

    public function index(Request $request, Response $response, array $args)
    {
    	try{
	    	$post = json_decode($request->getBody(),true);
	  
			if ( $post == null || count($post) == "0" || !isset($post['username']) || !isset($post['password']) 
				|| empty($post['username'])|| empty($post['password']) ) {
				return $response->withStatus(400);
			} else if( LoginResource::validate($post['username'], $post['password']) ){

		    	$key = 'apikeytoken';
			    $token = array(
			        "service" => "api_cats"
			    );

			    $jwt = JWT::encode($token, $key);

			    return $response->withJson(["jwt" => $jwt], 200)
			        ->withHeader('Content-type', 'application/json'); 

		    } else {
			     return $response->withJson(['error' => true, 
			     						'message' => 'These credentials do not match our records.']);
		    }
	
		}  catch (\Illuminate\Database\QueryException $ex) {
			     return $response->withStatus(500);
	    }
    }
}