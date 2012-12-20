<?php

use Nette\Http\Request;
use Telepat\Application\Routers\Route;
use Nette\Http\UrlScript;
use Nette\Http\Url;
use Nette\Application\Request as AppRequest;

/**
 * @author Michal Kvasničák <michal.kvasnicak@gmail.com>
 */
class RouteTest extends PHPUnit_Framework_TestCase
{

    public function testHTTPMethodsMatch()
    {
        $url = new UrlScript('http://localhost/test');

        foreach (['GET', 'POST', 'PUT', 'DELETE'] as $m)
        {
            $route = new Route($m, 'test', 'Test:index');

            $request = new Request($url, null, null, null, null, null, $m);

            $this->assertTrue($route->match($request) !== null);

            // try other (has to not match)
            foreach (array_diff(['GET', 'POST', 'PUT', 'DELETE'], [$m]) as $method)
            {
                $request = new Request($url, null, null, null, null, null, $method);

                $this->assertTrue($route->match($request) === null);
            }
        }
    }


    public function testAnyMethod()
    {
        $url = new UrlScript('http://localhost/test');

        $route = new Route('get|post|put|delete', 'test', 'Test:index');

        foreach (['GET', 'POST', 'PUT', 'DELETE'] as $m)
        {
            $request = new Request($url, null, null, null, null, null, $m);

            $this->assertTrue($route->match($request) !== null);
        }
    }


    public function testConstructUrlMethod()
    {
        $route = new Route(
            'get|post',
            '<presenter>/test',
            [
                'presenter' => 'Homepage',
                'action' => 'test'
            ]
        );

        $refUrl = new Url('http://localhost');
        $appReq = new AppRequest('Homepage:test', 'GET', ['_method' => 'GET']);

        $this->assertTrue($route->constructUrl($appReq, $refUrl) !== null);

        $appReq = new AppRequest('Homepage:test', 'GET', ['_method' => 'POST']);

        $this->assertTrue($route->constructUrl($appReq, $refUrl) !== null);

        $appReq = new AppRequest('Homepage:test', 'DELETE', ['_method' => 'DELETE']);

        $this->assertTrue($route->constructUrl($appReq, $refUrl) === null);
    }

}
