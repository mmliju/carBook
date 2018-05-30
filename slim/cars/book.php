<?php
error_reporting(-1);
ini_set('display_errors', 'On');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';
require '../classes/main.class.php';
//--------------------------------------------------------------------
$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write(' [{"name":"Jani","country":"Norway"},{"name":"Hege","country":"Sweden"},{"name":"Kali","country":"Germany"}] ');

    return $response;
});
//-----------------------------------------------------
$app->get('/rooms', function (Request $request, Response $response) {
   $obj = new dbInfo();
   $response->withHeader('Content-type', 'application/json');
   $result = $obj->get_rooms();

   $response->getBody()->write(json_encode($result));
   return $response;
});
//-----------------------------------------------------
$app->get('/cars', function (Request $request, Response $response) {
   $obj = new dbInfo();
   $response->withHeader('Content-type', 'application/json');
   $result = $obj->get_slots();

   $response->getBody()->write(json_encode($result));
   return $response;
});
//-------------------------------------------------------
$app->post('/saveSlot', function (Request $request, Response $response) {
   //$obj = new dbInfo();
   $response->withHeader('Content-type', 'application/json');
   $result = $request->params('mobile');

   $response->getBody()->write(json_encode($result));
   return $response;
});
$app->run();
?>
