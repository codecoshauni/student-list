<?php

namespace Students\Model;

class StudentValidator
{
    private $studentsDataGateway;
    private $errors = [];

    public function __construct(StudentsDataGateway $studentsDataGateway)
    {
        $this->studentsDataGateway = $studentsDataGateway;
    }

    public function verifyStudentData(Student $student)
    {
        $this->errors['name'] = $this->verifyName($student->getName());
        $this->errors['surname'] = $this->verifyName($student->getSurname(), 30);
        $this->errors['email'] = $this->verifyEmail($student->getEmail());
        $this->errors['birth_year'] = $this->verifyBirthYear($student->getBirthYear());
        $this->errors['group_number'] = $this->verifyGroupNumber($student->getGroupNumber());
        $this->errors['points'] = $this->verifyPoints($student->getPoints());
        $this->errors['sex'] = $this->verifySex($student->getSex());
        $this->errors['habitation'] = $this->verifyHabitation($student->getHabitation());
        return (implode('', $this->errors) == '') ? [] : $this->errors;
    }

    private function verifyName(string $name, int $maxLength = 20)
    {
        $error = '';
        if (mb_strlen($name) < 2) $error .= "Name can't be shorter than 2 characters. ";
        if (mb_strlen($name) > $maxLength) $error .= "Name can't be longer than {$maxLength} characters. ";
        if (!preg_match("/^[a-zA-Zа-яА-Я ,.'-]+$/ui", $name)) {
            $error .= 'Invalid character(s), only letters(EN and RU) and (,.\'-) are allowed.';
        }
        return $error;
    }

    private function verifyEmail(string $email, int $maxLength = 40)
    {
        $error = '';
        if (mb_strlen($email) < 2) $error .= "Email can't be shorter than 3 characters. ";
        if (mb_strlen($email) > $maxLength) $error .= "Email can't be longer than {$maxLength} characters. ";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= 'Invalid email';
        }
        return $error;
    }

    private function verifyBirthYear(int $birthYear)
    {
        $error = '';
        if ($birthYear > intval(date('Y') - 14)) $error .= "Age can't be less than 14 years. ";
        if ($birthYear < intval(date('Y') - 110)) $error .= "Age can't be more than 110. ";
        return $error;
    }

    private function verifyGroupNumber(string $group_number)
    {
        $error = '';
        if (mb_strlen($group_number) < 2) $error .= "Group number can't be shorter than 2 characters. ";
        if (mb_strlen($group_number) > 5) $error .= "Group number be longer than 5 characters. ";
        if (!preg_match("/^[a-zA-Zа-яА-Я0-9]+$/ui", $group_number)) {
            $error .= 'Invalid character(s), only letters(EN and RU) and digits are allowed.';
        }
        return $error;
    }

    private function verifyPoints(int $points)
    {
        $error = '';
        if ($points < 7) $error .= "Amount of points can't be less than 7. ";
        if ($points > 400) $error .= "Amount of points can't be more than 400. ";
        return $error;
    }

    private function verifySex(string $sex)
    {
        if (($sex !== Student::SEX_FEMALE) && ($sex !== Student::SEX_MALE)) {
            return "Sorry, but you gender ({$sex}) is non-existent";
        }

        return '';
    }

    private function verifyHabitation(string $habitation)
    {
        if (($habitation !== Student::HABITATION_LOCAL) && ($habitation !== Student::HABITATION_NONRESIDENT)) {
            return "Sorry, but you ({$habitation}) is non-existent";
        }

        return '';
    }
}