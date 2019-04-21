<?php

namespace controller;

class ProfileController
{
    private $container;
    private $studentsDataGateway;
    private $validator;

    public function __construct(\DIContainer $container)
    {
        $this->container = $container;
        $this->studentsDataGateway = $this->container->get('studentsDataGateway');
        $this->validator = $this->container->get('validator');
    }

    public function run() {
        require_once('../templates/profile.php');
    }
}