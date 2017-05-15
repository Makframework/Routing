<?php

namespace Makframework\Routing;


use Makframework\Http\Request;

class Router implements RouterMethodsInterface
{
    /**
     * @var RouteCollection[]
     */
    private $routes = [];

    /**
     * @var Request
     */
    private $request;

    /**
     * Methods allowed
     * @var array
     */
    private static $methodsAllowed = ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'];

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;

        foreach(self::$methodsAllowed as $method) {
            $this->routes[$method] = new RouteCollection();
        }
    }

    /**
     * Get
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function get(string $route, $resource, array $middlewares = []): Route
    {
        return $this->routes['GET']->add($route, $resource, $middlewares);
    }

    /**
     * Post
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function post(string $route, $resource, array $middlewares = []): Route
    {
        return $this->routes['POST']->add($route, $resource, $middlewares);
    }

    /**
     * Put
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function put(string $route, $resource, array $middlewares = []): Route
    {
        return $this->routes['PUT']->add($route, $resource, $middlewares);
    }

    /**
     * Patch
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function patch(string $route, $resource, array $middlewares = []): Route
    {
        return $this->routes['PATCH']->add($route, $resource, $middlewares);
    }

    /**
     * Delete
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function delete(string $route, $resource, array $middlewares = []): Route
    {
        return $this->routes['DELETE']->add($route, $resource, $middlewares);
    }

    /**
     * Options
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function options(string $route, $resource, array $middlewares = []): Route
    {
        return $this->routes['OPTIONS']->add($route, $resource, $middlewares);
    }

    /**
     * Any
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function any(string $route, $resource, array $middlewares = [])
    {
        foreach(self::$methodsAllowed as $method) {
            $this->routes[$method]->add($route, $resource, $middlewares);
        }
    }

    /**
     * Match
     * @param array $methods
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function match(array $methods, string $route, $resource, array $middlewares = [])
    {
        foreach ($methods as $method) {
            $method = strtoupper($method);
            if(in_array($method, self::$methodsAllowed)) {
                $this->routes[$method]->add($route, $resource, $middlewares);
            }
        }
    }

    public function routing()
    {
        $method = $this->request->getMethod();

        if(in_array($method, self::$methodsAllowed))
        {
            $resource = $this->routes[$method]->resolve($this->request->getPath())->getResource();

            call_user_func_array($resource->getAction(), $resource->getParameters());
        }
    }
}