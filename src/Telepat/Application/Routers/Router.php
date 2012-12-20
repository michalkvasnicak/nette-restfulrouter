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
 */
class Router extends \Nette\Application\Routers\RouteList
{


    /**
     * HTTP GET method route
     *
     * @param string $mask
     * @param array  $metadata
     * @param int    $flags
     */
    public function get($mask, $metadata = [], $flags = 0)
    {
        $this[] = new Route('get', $mask, $metadata, $flags);
    }

}
