<?php
/**
 * @author Michal Kvasničák <michal.kvasnicak@gmail.com>
 */
class RouterTest extends PHPUnit_Framework_TestCase
{

    public function testGetMethod()
    {
        $router = new \Telepat\Application\Routers\Router();

        $router->get('<presenter>/<action>', 'Homepage:index');

        $this->assertCount(1, $router);
    }


    public function testPostMethod()
    {
        $router = new \Telepat\Application\Routers\Router();

        $router->post('<presenter>/<action>', 'Homepage:index');

        $this->assertCount(1, $router);
    }


    public function testDeleteMethod()
    {
        $router = new \Telepat\Application\Routers\Router();

        $router->delete('<presenter>/<action>', 'Homepage:index');

        $this->assertCount(1, $router);
    }


    public function testPutMethod()
    {
        $router = new \Telepat\Application\Routers\Router();

        $router->put('<presenter>/<action>', 'Homepage:index');

        $this->assertCount(1, $router);
    }


    public function testAnyMethod()
    {
        $router = new \Telepat\Application\Routers\Router();

        $router->any('<presenter>/<action>', 'Homepage:index');

        $this->assertCount(1, $router);
    }


    public function testMatchMethod()
    {
        $router = new \Telepat\Application\Routers\Router();

        $router->matching('get|post', 'Homepage:index');

        $router->matching(['get', 'post'], 'Homepage:index');

        $this->assertCount(2, $router);
    }

}
