<?php
error_reporting(-1);
ini_set('display_errors', 'On');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';
require 'classes/main.class.php';
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
   $obj = new dbInfo();
   $response->withHeader('Content-type', 'application/json');
   $result  = $request->getParsedBody();
   $data['phone']  = filter_var($result['mobile'], FILTER_SANITIZE_STRING);
   $data['vehicle_number']  = filter_var($result['vnumber'], FILTER_SANITIZE_STRING);
   $data['slot_time']  = filter_var($result['slot'], FILTER_SANITIZE_STRING);
   $data['slot_id']  = filter_var($result['slotid'], FILTER_SANITIZE_STRING);
   //----------------------------------------------------------------------
   $returnResult = $obj->reserve_slot($data);
   //---------------mail------------------------------------------
   //=======================================================================
    $to = "lijumoolackal@gmail.com";
	$subject = "New booking ".date("d-m-Y")." ".$data['slot_time'];
	
	$message ="<p>New booking has been registered with following details</p> Vehicle Number : ".$data['vehicle_number']."<br/>Phone Number : ".$data['phone']."<br/>Slot : ".$data['slot_time'];
	
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	// More headers
	$headers .= 'From: <support@redefineyourshine.com>' . "\r\n";
	
	mail($to,$subject,$message,$headers);
   //-----------------------------------------------------------------------
   $response->getBody()->write("test");
   return $response;
});
$app->run();
?>
