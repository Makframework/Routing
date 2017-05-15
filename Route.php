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

    public function get(string $route) : ?Resource
    {
        if($resource = $this->has($route)) return $resource;
        throw new RouteNotFoundException("Route not found.");
    }

    /**
     * Has
     * @param string $route
     */
    public function has(string $currentRoute)
    {
        foreach ($this->routes as $route => $resource)
        {
            if(preg_match('#^'.$route.'$#', $currentRoute, $parameters))
            {
                array_shift($parameters);
                $this->routes[$route] = Resource($resource, $parameters);
                return true;
            }
        }
        return false;
    }

}