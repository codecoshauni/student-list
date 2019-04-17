<?php

namespace model;

class StudentsDataGateway
{
    private $dbconnection;

    public function __construct($pdo)
    {
        $this->dbconnection = $pdo;
    }
}