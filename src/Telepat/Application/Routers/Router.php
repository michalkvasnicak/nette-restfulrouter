<?php

namespace Telepat\Application\Routers;

/**
 * Telepat restful router
 *
 * @author    Michal Kvasničák <michal.kvasnicak@telep.at>
 *
 * @copyright Copyright (c) 2012, Telepat
 * @license   http://telep.at/license/commercial.html
 *
 * @package Telepat
 *
 * @method get($mask, $metadata = [], $flags = 0)
 * @method post($mask, $metadata = [], $flags = 0)
 * @method put($mask, $metadata = [], $flags = 0)
 * @method delete($mask, $metadata = [], $flags = 0)
 *
 */
class Router extends \Nette\Application\Routers\RouteList
{


    /**
     * @param $name
     * @param $args
     *
     * @return mixed|Router
     * @throws \InvalidArgumentException
     */
    public function __call($name, $args)
    {
        if (in_array($name, ['get', 'post', 'put', 'delete']))
        {
            if (count($args) < 1)
            {
                throw new \InvalidArgumentException('Mask has to be set.');
            }

            $metadata = isset($args[1]) ? $args[1] : [];
            $flags = isset($args[2]) ? $args[2] : 0;

            $this[] = new Route($name, $args[0], $metadata, $flags);

            return $this;
        }

        return parent::__call($name, $args);
    }


    /**
     * Creates route for any HTTP method
     *
     * @param string $mask
     * @param array  $metadata
     * @param int    $flags
     *
     * @return Router
     */
    public function any($mask, $metadata = [], $flags = 0)
    {
        $this[] = new Route('get|post|put|delete', $mask, $metadata, $flags);

        return $this;
    }


    /**
     * Creates route for matching given HTTP methods
     *
     * @param array|string  $method
     * @param string        $mask
     * @param array         $metadata
     * @param int           $flags
     *
     * @return Router
     */
    public function matching($method, $mask, $metadata = [], $flags = 0)
    {
        $this[] = new Route($method, $mask, $metadata, $flags);

        return $this;
    }

}
