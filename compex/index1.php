<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();


$config = require_once('config/local.php');
require_once('classes/index.php');



$app = new \Slim\Slim();


$app->get('/', function() use ($app) {
        $testObj = new Test();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($testObj->getMsg());
    }
);


$app->get('/bestsellers', function() use ($app) {
        $dataObj = new Dataprovider();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($dataObj->getBestsellers());
    }
);

$app->get('/categories', function() use ($app) {
        $dataObj = new Dataprovider();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($dataObj->getCategories());
    }
);

$app->get('/productsByCat', function() use ($app) {
	$id = $app->request()->params('id');
	$dataObj = new Dataprovider();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($dataObj->getProductsByCat($id));
    }
);

$app->get('/getProductsByAlias', function() use ($app) {
	$alias = $app->request()->params('alias');
	$dataObj = new Dataprovider();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($dataObj->getProductsByAlias($alias));
    }
);

$app->get('/getProductDetailsById', function() use ($app) {
	$id = $app->request()->params('id');
	$lang = $app->request()->params('lang');
	$dataObj = new Dataprovider();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($dataObj->getProductDetailsById($id, $lang));
    }
);

$app->get('/getGroups', function() use ($app) {
	$id = $app->request()->params('id');
	$dataObj = new Dataprovider();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($dataObj->getGroups($id));
    }
);

$app->get('/getPacks', function() use ($app) {
	$id = $app->request()->params('id');
	$dataObj = new Dataprovider();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($dataObj->getPacks($id));
    }
);

$app->get('/doit', function() use ($app) {
        $dataObj = new Dataprovider();
        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setBody($dataObj->doit());
    }
);


// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
