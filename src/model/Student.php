<?php

namespace model;

class Student
{
    private const GENDER_MALE = 'male';
    private const GENDER_FEMALE = 'female';
    private const HABITATION_LOCAL = 'local';
    private const HABITATION_NONRESIDENT= 'nonresident';

    private $id;
    private $token;
    private $name;
    private $surname;
    private $sex;
    private $group_number;
    private $email;
    private $points;
    private $birth_year;
    private $habitation;

    public function __construct()
    {

    }
}