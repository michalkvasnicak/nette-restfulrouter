Restful Router for Nette Framework
==================================

---

This is implementation of simple restful router for Nette Framework. It provides simple interface for creating routes for any HTTP method.

It also provides url constructing!


Defining routes
---------------


    <?php

    use Misiak\Application\Routers\Router;
    use Misiak\Application\Routers\Route;

    $router = new Router;

    // create route only for http get method
    $router->get('<presenter>/<action>', 'Homepage:default');

    // create route only for http post method
    $router->post('api/users', 'Users:default');

    //$router->put(..., ...);
    //$router->delete(..., ...);

    // create route for any http method
    $router->any('<presenter>/<action>', 'Homepage:default');

    // create route only for given methods

    $router->matching('get|post', '<presenter>/<action>', 'Homepage:default');

    // or
    $router->matching(['get', 'post'], '<presenter>/<action>', 'Homepage:default');

    // or as in classic "nette" way
    $router[] = new Route('get|post', '<presenter>/<action>', 'Homepage:default');


Generating urls (Latte, ...)
----------------------------

There can be problem with url constructing if you have route for POST HTTP method and want to create url with $presenter->link(...).
This can be avoided simple by defining `_method` parameter for your link.


    <?php

    // we have route
    $route = new Route('post', '/api/users', 'Homepage:default');

    // we want to generate link for this route
    $presenter->link('Homepage:default'); //this won't generate url! because it is for GET methods

    // use this!
    $presenter->link('Homepage:default', ['_method' => 'post']);

In Latte templates just use `{link Homepage:default, '_method' => 'post'}`
