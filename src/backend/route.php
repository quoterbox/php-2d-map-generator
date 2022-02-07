<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

try{
    $routes = new RouteCollection();

    $routes->add('asset_packs', new Route('/api/assets/', ['controller' => Backend\Controllers\AssetsController::class, 'action' => 'getAssets']));
    $routes->add('algorithms_list', new Route('/api/algorithms/', ['controller' => Backend\Controllers\AlgorithmsController::class, 'action' => 'getAlgorithms']));

    $context = new RequestContext();
    $context->fromRequest(Request::createFromGlobals());

    $matcher = new UrlMatcher($routes, $context);
    $parameters = $matcher->match($context->getPathInfo());

    $controllerName = $parameters['controller'];
    $methodName = $parameters['action'];

    $controller = new $controllerName;
    $response = $controller->$methodName();

    echo $response;
    exit;

}catch (ResourceNotFoundException $e){

    if($context->getPathInfo() !== '/'){
        http_response_code(404);
        include('error.php');
        exit;
    }
//    else{
//        messInfo('All is good');
//        messInfo($context->getPathInfo());
//    }

}
