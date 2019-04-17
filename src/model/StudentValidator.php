<?php

namespace model;

class StudentValidator
{
    private $studentsDataGateway;

    public function __construct(StudentsDataGateway $studentsDataGateway)
    {
        $this->studentsDataGateway = $studentsDataGateway;
    }
}