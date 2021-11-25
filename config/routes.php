<?php

use App\Controller\ClientControllerForPhp;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('clients_infos', '/php/client/info/{nom}')
        ->controller([ClientControllerForPhp::class, 'info'])
    ;

    $routes->add('clients_photos', '/php/client/photo')
        ->controller([ClientControllerForPhp::class, 'photo'])
    ;

    $routes->add('clients_prenoms', '/php/client/prenom/{nom}')
        ->controller([ClientControllerForPhp::class, 'prenom'])
        ->requirements(['url' => '[a-zA-Z]+-[a-zA-Z]+?'])
    ;
};