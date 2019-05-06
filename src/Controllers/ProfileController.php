<?php

namespace Students\Controllers;

class ProfileController
{
    const NOTICE_REG = 'Your profile has been successfully added to the list!';
    const NOTICE_EDIT = 'Your profile data has been successfully changed!';
    const HEADER_REG = 'Enter information about yourself to register';
    const HEADER_EDIT = 'You can change your profile information';

    private $container;
    private $studentsDataGateway;
    private $validator;

    public function __construct(\Students\DIContainer $container)
    {
        $this->container = $container;
        $this->studentsDataGateway = $this->container->get('studentsDataGateway');
        $this->validator = $this->container->get('validator');
    }

    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->getRequestHandler();
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->postRequestHandler();
        } else {
            header("HTTP/1.0 404 Not Found");
            include_once('../../templates/error.php');
            die();
        }
    }

    private function isUserRegistered()
    {
        $token = $_COOKIE['token'] ?? 0;
        return $this->studentsDataGateway->isTokenExist($token);
    }

    private function getRequestHandler()
    {
        if ($this->isUserRegistered()) {
            $studentData = $this->studentsDataGateway->getOneByToken($_COOKIE['token']);
            if (isset($_GET['notice'])) {
                if ($_GET['notice'] == 'reg') $notice = self::NOTICE_REG;
                if ($_GET['notice'] == 'edt') $notice = self::NOTICE_EDIT;
            } else {
                $notice = '';
            }
            $this->render(self::HEADER_EDIT, $notice, $studentData);
        } else {
            $this->render(self::HEADER_REG);
        }
    }

    private function postRequestHandler()
    {
        $headerCaption = '';
        $student = $this->createStudentFromPost();
        $errors = $this->validator->verifyStudentData($student);

        if (empty($errors)) {
            if ($this->isUserRegistered()) {
                $this->studentsDataGateway->editStudent($_COOKIE['token'], $student);
                $redirectionUrl = '/profile?notice=edt';
            } else {
                do {
                    $token = bin2hex(random_bytes(32));
                } while($this->studentsDataGateway->isTokenExist($token));
                setcookie(
                    'token',
                    $token,
                    strtotime('+10 years'),
                    null,
                    null,
                    null,
                    true
                );
                $this->studentsDataGateway->addStudent($token, $student);
                $redirectionUrl =  '/profile?notice=reg';
            }
            header("Location: {$redirectionUrl}");
            die();
        } else {
            if ($this->isUserRegistered()) $headerCaption = self::HEADER_EDIT;
            if ($this->isUserRegistered() == false) $headerCaption = self::HEADER_REG;
            $studentData['name'] = $student->getName();
            $studentData['surname'] = $student->getSurname();
            $studentData['sex'] = $student->getSex();
            $studentData['group_number'] = $student->getGroupNumber();
            $studentData['email'] = $student->getEmail();
            $studentData['points'] = $student->getPoints();
            $studentData['birth_year'] = $student->getBirthYear();
            $studentData['habitation'] = $student->getHabitation();
            $this->render($headerCaption, 'Invalid information!', $studentData, $errors);
        }
    }

    private function createStudentFromPost()
    {
        $name = strval($_POST['name']) ?? '';
        $surname = strval($_POST['surname']) ?? '';
        $sex = strval($_POST['sex']) ?? '';
        $group_number = strval($_POST['group_number']) ?? 0;
        $email = strval($_POST['email']) ?? '';
        $points = intval($_POST['points']) ?? 0;
        $birth_year = intval($_POST['birth_year']) ?? 0;
        $habitation = strval($_POST['habitation']) ?? '';
        $student = new \Students\Model\Student($name, $surname, $sex, $group_number, $email, $points,  $birth_year, $habitation);
        return $student;
    }

    private function render(string $headerCaption, string $notice = '', array $studentData = [], array $errors = [])
    {
        require_once('../templates/profile.php');
    }
}