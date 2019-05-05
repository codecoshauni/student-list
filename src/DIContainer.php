<?php

namespace Students;

class DIContainer
{
    private $registeredServices = [];
    private $servicesObjects = [];

    public function register(string $name, callable $factory)
    {
        if (array_key_exists($name, $this->registeredServices)) {
            throw new UserExceptions\DIContainerException("Service {$name} already exist");
        } else {
            $this->registeredServices[$name] = $factory;
        }
    }

    public function get(string $name)
    {
        if (!array_key_exists($name, $this->registeredServices)) {
            throw new UserExceptions\DIContainerException("Unregistered service {$name}");
        }

        if (array_key_exists($name, $this->servicesObjects)) {
            return $this->servicesObjects[$name];
        } else {
            $this->servicesObjects[$name] = call_user_func($this->registeredServices[$name], $this);
            return $this->servicesObjects[$name];
        }
    }
}