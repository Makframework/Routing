<?php

namespace Makframework\Routing;


class Resource
{
    /**
     * Resource
     * @var callable|string
     */
    private $resource;

    /**
     * Parameters
     * @var array
     */
    private $parameters;

    public function __construct($resource, array $parameters = [])
    {
        $this->resource = $resource;
        $this->parameters = $parameters;
    }

    /**
     * @return callable|string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return array
     */
    public function getParameters() : array
    {
        return $this->parameters;
    }

    public function call()
    {
        if(is_string($this->resource))
        {
            $this->resource = explode('@', $this->resource);

            if(!isset($this->resource[1])) $this->resource[1] = '__invoke';

                $reflectMethod = new \ReflectionMethod($this->resource[0], $this->resource[1]);

                $this->resource = $reflectMethod->getClosureThis();
        }

        if(is_callable($this->resource))
            return call_user_func_array($this->resource, $this->parameters);

        //Aqui lanzariamos una excepcion ya que no se ha podido llamar al resource
        return false;
    }
}