<?php

namespace Makframework\Routing;


class Resource
{
    /**
     * Action
     * @var callable|string
     */
    private $action;

    /**
     * Parameters
     * @var array
     */
    private $parameters;

    public function __construct($action, array $parameters = [])
    {
        $this->setAction($action);
        $this->setParameters($parameters);
    }

    /**
     * @return callable|string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParameters() : array
    {
        return $this->parameters;
    }

    /**
     * @param callable|string $action
     */
    public function setAction($action): void
    {
        if(is_string($action))
        {
            $action = explode('@', $action);

            if(!isset($action[1])) $action[1] = '__invoke';

            $reflection = new \ReflectionClass($action[0]);

            $action[0] = $reflection->newInstance();
        }
        $this->action = $action;
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }
}