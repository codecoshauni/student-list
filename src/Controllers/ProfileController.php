<?php

namespace Students\Controllers;

use Students\Error404Output;
use Students\Model\{StudentsDataGateway, Student};

class ProfileController
{
    use Error404Output;

    const NOTICE_REG = 'reg';
    const NOTICE_EDIT = 'edit';
    const HEADER_REG = 'Enter information about yourself to register';
    const HEADER_EDIT = 'You can change your profile information';
    const MESSAGES_INTERPRETATION = [self::NOTICE_REG => 'Your profile has been successfully added to the list!',
        self::NOTICE_EDIT => 'Your profile data has been successfully changed!'
    ];

    private $container;
    private $studentsDataGateway;
    private $validator;

    public function __construct(\Students\DIContainer $container)
    {
        $this->container = $container;
        $this->studentsDataGateway = $this->container->get(StudentsDataGateway::class);
        $this->validator = $this->container->get('validator');
    }

    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->getRequestHandler();
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->postRequestHandler();
        } else {
            $this->printError();
        }
    }

    private function isUserRegistered()
    {
        $token = $_COOKIE['token'] ?? 0;
        return $this->studentsDataGateway->isTokenExist($token);
    }

    private function generateToken() {
        do {
            $token = bin2hex(random_bytes(32));
        } while($this->studentsDataGateway->isTokenExist($token));

        return $token;
    }

    private function getRequestHandler()
    {
        $xsrfToken = $this->generateToken();
        setcookie(
            'xsrfToken',
            $xsrfToken,
            strtotime('+1 hour'),
            null,
            null,
            null,
            true
        );
        if ($this->isUserRegistered()) {
            $studentData = $this->studentsDataGateway->getOneByToken($_COOKIE['token']);
            if (isset($_GET['notice'])) {
                if ($_GET['notice'] == self::NOTICE_REG) $notice = self::MESSAGES_INTERPRETATION[self::NOTICE_REG];
                if ($_GET['notice'] == self::NOTICE_EDIT) $notice = self::MESSAGES_INTERPRETATION[self::NOTICE_EDIT];
            } else {
                $notice = '';
            }

            $this->render(self::HEADER_EDIT, $notice, $xsrfToken, new Student($studentData));
        } else {
            $this->render(self::HEADER_REG, '', $xsrfToken);
        }
    }

    private function postRequestHandler()
    {
        $xsrfTokenFromForm = strval($_POST['xsrfToken'] ?? '');
        $xsrfTokenFromCookie = $_COOKIE['xsrfToken'];
        if ($xsrfTokenFromForm != $xsrfTokenFromCookie) $this->printError();
        $headerCaption = '';
        $studentData = $this->createArrayFromPost();
        if ($this->isUserRegistered()) $studentData['token'] = $_COOKIE['token'];
        $errors = $this->validator->verifyStudentData($studentData);

        if (empty($errors)) {
            if ($this->isUserRegistered()) {
                $student = new Student($this->studentsDataGateway->getOneByToken($_COOKIE['token']));
                $student->setName($studentData['name']);
                $student->setSurname($studentData['surname']);
                $student->setSex($studentData['sex']);
                $student->setGroupNumber($studentData['group_number']);
                $student->setEmail($studentData['email']);
                $student->setPoints($studentData['points']);
                $student->setBirthYear($studentData['birth_year']);
                $student->setHabitation($studentData['habitation']);
                $this->studentsDataGateway->editStudent($_COOKIE['token'], $student);
                $redirectionUrl = '/profile?notice=' . self::NOTICE_EDIT;
            } else {
                $student = new Student($studentData);
                $token = $this->generateToken();
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
                $redirectionUrl =  '/profile?notice=' . self::NOTICE_REG;
            }
            header("Location: {$redirectionUrl}");
            die();
        } else {
            $student = new Student($studentData);
            if ($this->isUserRegistered()) $headerCaption = self::HEADER_EDIT;
            if ($this->isUserRegistered() == false) $headerCaption = self::HEADER_REG;
            $this->render($headerCaption, 'Invalid information!', '', $student, $errors);
        }
    }

    private function createArrayFromPost()
    {
        $studentData['name'] = strval($_POST['name'] ?? '');
        $studentData['surname'] = strval($_POST['surname'] ?? '');
        $studentData['sex'] = strval($_POST['sex'] ?? '');
        $studentData['group_number'] = strval($_POST['group_number'] ?? 0);
        $studentData['email'] = strval($_POST['email'] ?? '');
        $studentData['points'] = intval($_POST['points'] ?? 0);
        $studentData['birth_year'] = intval($_POST['birth_year'] ?? 0);
        $studentData['habitation'] = strval($_POST['habitation'] ?? '');
        return $studentData;
    }

    private function render(string $headerCaption, string $notice = '', $xsrfToken = '', Student $student = null, array $errors = [])
    {
        require_once('../templates/profile.php');
    }
}