<?php

namespace controller;

class ListOutputController
{
    private $container;
    private $studentsDataGateway;

    public function __construct(\DIContainer $container)
    {
        $this->container = $container;
        $this->studentsDataGateway = $this->container->get('studentsDataGateway');
    }

    public function run() {
        require_once('../templates/students-list.php');
    }
}