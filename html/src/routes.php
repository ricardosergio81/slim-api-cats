<?php

use rs81\Controllers as Controllers ;

/**
 * @OA\Info(
 *      title="Slim Cat Api",
 *      version="0.1",
 *      @OA\Contact(
 *          name="Ricardo Sergio Rosa",
 *          email="ricardosergio81@gmail.com",
 *          url="http://github.com/ricardosergio81/slim-api-cats" 
 *      )
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="Authorization",
 *      type="apiKey"
 * )
 *
 */

#Define Middleware
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "ignore" => ["/login","/swagger"],
    "secure" => false,
    "secret" => "apikeytoken",
	"error" => function ($response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));

#Define routes
$app->post('/login', Controllers\Login::class.':index');
$app->get('/breeds', Controllers\Breeds::class.':index');
