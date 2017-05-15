<?php

namespace Makframework\Routing;


use Makframework\Routing\Exceptions\RouteNotFoundException;

class Routes
{
    /**
     * routes
     * @var array
     */
    private $routes = [];

    public function __construct()
    {

    }

    /**
     * Add
     * @param string $route
     * @param string|callable $resource
     */
    public function add(string $route, $resource)
    {
        $this->routes[$route] = $resource;
    }

    /**
     * @param string $route
     * @return null|\Makframework\Routing\Resource
     */
    public function get(string $route) : ?Resource
    {
        if($resource = $this->has($route)) return $resource;
        throw new RouteNotFoundException("Route not found.");
    }

    /**
     * @param string $currentRoute
     * @return bool|\Makframework\Routing\Resource
     */
    public function has(string $currentRoute)
    {
        foreach ($this->routes as $route => $resource)
        {
            if(preg_match('#^'.$route.'$#', $currentRoute, $parameters))
            {
                array_shift($parameters);
                return Resource($resource, $parameters);
            }
        }
        return false;
    }

}