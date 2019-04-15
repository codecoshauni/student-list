<?php

namespace model;

class StudentDataGateway
{
    private $dbc;

    public function __construct($dbconnection)
    {
        $this->dbc = $dbconnection;
    }
}