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

    public function __construct(array $studentData) {
        $this->name = $studentData['name'];
        $this->surname = $studentData['surname'];
        $this->sex = $studentData['sex'];
        $this->group_number = $studentData['group_number'];
        $this->email = $studentData['email'];
        $this->points = $studentData['points'];
        $this->birth_year = $studentData['birth_year'];
        $this->habitation = $studentData['habitation'];
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

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function setSex(string $sex)
    {
        $this->sex = $sex;
    }

    public function setGroupNumber(string $group_number)
    {
        $this->group_number = $group_number;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPoints(int $points)
    {
        $this->points = $points;
    }

    public function setBirthYear(int $birth_year)
    {
        $this->birth_year = $birth_year;
    }

    public function setHabitation(string $habitation)
    {
        $this->habitation = $habitation;
    }

}