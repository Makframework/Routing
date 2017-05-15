<?php

namespace Makframework\Routing;

class Route
{
    /**
     * @var \Makframework\Routing\Resource
     */
    private $resource;

    /**
     * @var \Makframework\Routing\Middleware[]
     */
    private $middlewares = [];

    /**
     * Route constructor.
     * @param Resource $resource
     * @param array $middlewares
     */
    public function __construct(Resource $resource, array $middlewares)
    {
        $this->resource = $resource;
        $this->middlewares = $middlewares;
    }

    /**
     * @return Resource
     */
    public function getResource(): Resource
    {
        return $this->resource;
    }

    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function addMiddleware(Middleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

}