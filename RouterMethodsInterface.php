<?php

namespace Makframework\Routing;

interface RouterMethodsInterface
{
    /**
     * Get
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function get(string $route, $resource, array $middlewares = []): Route;

    /**
     * Post
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function post(string $route, $resource, array $middlewares = []): Route;

    /**
     * Put
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function put(string $route, $resource, array $middlewares = []): Route;

    /**
     * Patch
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function patch(string $route, $resource, array $middlewares = []): Route;

    /**
     * Delete
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function delete(string $route, $resource, array $middlewares = []): Route;

    /**
     * Options
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function options(string $route, $resource, array $middlewares = []): Route;

    /**
     * Any
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function any(string $route, $resource, array $middlewares = []);

    /**
     * Match
     * @param array $methods
     * @param string $route
     * @param $resource
     * @param array $middlewares
     * @return Route
     */
    public function match(array $methods, string $route, $resource, array $middlewares = []);
}