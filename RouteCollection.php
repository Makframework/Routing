<?php

namespace Makframework\Routing;


use Makframework\Routing\Exceptions\RouteNotFoundException;

class RouteCollection
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
    public function add(string $route, $resource, array $middlewares) : Route
    {
       return $this->routes[$route] = new Route(new Resource($resource), $middlewares);
    }

    /**
     * @param string $route
     * @return null|\Makframework\Routing\Resource
     */
    public function get(string $route) : ?Route
    {
        if($this->has($route)) return $this->routes[$route];

        throw new RouteNotFoundException("Route not found.");
        return null;
    }

    public function has(string $route): bool
    {
        return isset($this->routes[$route]);
    }

    /**
     * @param string $currentRoute
     * @return bool|\Makframework\Routing\Resource
     */
    public function resolve(string $currentRoute) : ?Route
    {
        foreach ($this->routes as $routeKey => $route)
        {
            if(preg_match('#^'.$routeKey.'$#', $currentRoute, $parameters))
            {
                array_shift($parameters);
                $route->getResource()->setParameters($parameters);
                return $route;
            }
        }

        throw new RouteNotFoundException("Route not found.");
    }

}