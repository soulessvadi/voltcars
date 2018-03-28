<?php
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');


Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Home', 'action' => 'index', 'index']);
    $routes->fallbacks('DashedRoute');
});

Router::connect('/auctions', ['controller' => 'Auctions', 'action' => 'index']);

Router::scope('/contacts', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Contacts', 'action' => 'index']);
});

Router::scope('/catalog', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Catalog', 'action' => 'index']);
});
Router::connect('/catalog/:id/', ['controller' => 'Catalog', 'action' => 'category'], ['pass' => ['id']]);
Router::connect('/catalog/:id/:item/*', ['controller' => 'Catalog', 'action' => 'item'], ['pass' => ['id','item']]);


Router::scope('/electrocars', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Electrocars', 'action' => 'index']);
});
Router::connect('/electrocars/:item/*', ['controller' => 'Electrocars', 'action' => 'itemCar'], ['pass' => ['item']]);


Router::scope('/charge', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Charge', 'action' => 'index']);
});

Router::scope('/blog', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Blog', 'action' => 'index']);
});
Router::connect('/blog/:post/*', ['controller' => 'Blog', 'action' => 'blogPost'], ['pass' => ['post']]);

Router::scope('/sitemap', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Sitemap', 'action' => 'index']);
});

Router::scope('/404', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Err404', 'action' => 'index']);
});


Plugin::routes();
