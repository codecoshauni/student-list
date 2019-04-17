<?php

namespace controller;

use model\StudentsDataGateway;

class ProfileController
{
    private $studentsDataGateway;

    public function __construct(StudentsDataGateway $studentsDataGateway)
    {
        $this->studentsDataGateway = $studentsDataGateway;
    }

    public function run() {

    }
}