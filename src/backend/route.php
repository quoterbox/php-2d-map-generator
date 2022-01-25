<?php

use Backend\Controllers\AssetController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

try{
    $assetRoute = new Route('/assets/folders/', [AssetController::class, 'getAssetsFolders']);
//    $assetRoute = new Route('/assets/folders/', ['_controller' => AssetController::class]);

    $routes = new RouteCollection();
    $routes->add('assets_folders', $assetRoute);

    $context = new RequestContext();
    $context->fromRequest(Request::createFromGlobals());


    $matcher = new UrlMatcher($routes, $context);
    $parameters = $matcher->match($context->getPathInfo());

    messInfo($parameters);
    debug($context->getPathInfo());

    debug('88879879879878787987978');

}catch (ResourceNotFoundException $e){
    messInfo($e->getMessage());
}


