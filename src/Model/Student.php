<?php

namespace Students\Model;

class Student
{
    const SEX_MALE = 'male';
    const SEX_FEMALE = 'female';
    const HABITATION_LOCAL = 'local';
    const HABITATION_NONRESIDENT = 'nonresident';

    private $name;
    private $surname;
    private $sex;
    private $group_number;
    private $email;
    private $points;
    private $birth_year;
    private $habitation;

    public function __construct(
        string $name,
        string $surname,
        string $sex,
        string $group_number,
        string $email,
        int $points,
        int $birth_year,
        string $habitation
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->sex = $sex;
        $this->group_number = $group_number;
        $this->email = $email;
        $this->points = $points;
        $this->birth_year = $birth_year;
        $this->habitation = $habitation;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function getGroupNumber()
    {
        return $this->group_number;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function getBirthYear()
    {
        return $this->birth_year;
    }

    public function getHabitation()
    {
        return $this->habitation;
    }

    public function getDataArray()
    {

    }
}