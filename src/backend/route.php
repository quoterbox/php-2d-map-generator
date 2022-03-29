<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

try{

    //
    // Routes
    //

    $routes = new RouteCollection();

    $routes->add('asset_packs',
        (new Route('/api/assets/', ['controller' => Backend\Controllers\AssetsController::class, 'action' => 'getAssets']))
            ->setMethods(['GET'])
    );

    $routes->add('algorithms_list',
        (new Route('/api/algorithms/', ['controller' => Backend\Controllers\AlgorithmsController::class, 'action' => 'getAlgorithms']))
            ->setMethods(['GET'])
    );

    $routes->add('generate_map',
        (new Route('/api/map-one-file/', ['controller' => Backend\Controllers\GeneratorController::class, 'action' => 'generateOneFileMap']))
            ->setMethods(['POST'])
    );

    $routes->add('generate_map_tiles',
        (new Route('/api/map-many-files/', ['controller' => Backend\Controllers\GeneratorController::class, 'action' => 'generateManyFilesMap']))
            ->setMethods(['POST'])
    );


    //
    // Matching URL params
    //

    $context = new RequestContext();
    $globalRequest = Request::createFromGlobals();
    $context->fromRequest($globalRequest);

    $matcher = new UrlMatcher($routes, $context);
    $parameters = $matcher->match($context->getPathInfo());

    $controllerName = $parameters['controller'];
    $methodName = $parameters['action'];


    //
    // Creating Controller and starting method
    //

    $controller = new $controllerName;

    $requestBody = $globalRequest->getContent();

    if(!empty($requestBody)){
        $response = $controller->$methodName($globalRequest->toArray());
    }else{
        $response = $controller->$methodName();
    }

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
