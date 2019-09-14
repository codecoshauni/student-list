<?php

namespace Students\Model;

use Students\Error404Output;

class StudentsDataGateway
{
    use Error404Output;
    const LIMIT = 50;

    const ALLOWED_BY = ['name', 'surname', 'group_number', 'points'];
    const ALLOWED_IN = ['asc', 'desc'];
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getStudentsCount($searchValue = '')
    {
        if (empty($searchValue)) {
            $stmt = $this->pdo->prepare("SELECT count(*) FROM students");
        } else {
            $stmt = $this->pdo->prepare("SELECT count(*) FROM students WHERE concat(name, \" \",surname, \" \",group_number, \" \",points) LIKE :searchValue");
            $stmt->bindValue(':searchValue', "%$searchValue%");
        }
        $stmt->execute();
        return $stmt->fetchcolumn();
    }

    public function isTokenExist(string $token)
    {
        $stmt = $this->pdo->prepare("SELECT `token` FROM students WHERE `token` = :token");
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        return (bool)$stmt->fetchcolumn();
    }

    public function isEmailExist(string $email, string $token = '')
    {
        $stmt = $this->pdo->prepare("SELECT count(email) FROM `students` WHERE `email` = :email AND `token` <> :token");
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        return (bool)$stmt->fetchcolumn();
    }

    public function getOneByToken(string $token)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `students` WHERE `token` = :token");
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addStudent(string $token, Student $student)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `students` ( 
            `token`,
            `name`, 
            `surname`, 
            `sex`, 
            `group_number`,   
            `email`, 
            `points`, 
            `birth_year`, 
            `habitation`
            ) VALUES ( 
            :token,        
            :name, 
            :surname, 
            :sex, 
            :group_number, 
            :email, 
            :points, 
            :birth_year, 
            :habitation
            )");
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':name', $student->getName());
        $stmt->bindValue(':surname', $student->getSurname());
        $stmt->bindValue(':sex', $student->getSex());
        $stmt->bindValue(':group_number', $student->getGroupNumber());
        $stmt->bindValue(':email', $student->getEmail());
        $stmt->bindValue(':points', $student->getPoints(), \PDO::PARAM_INT);
        $stmt->bindValue(':birth_year', $student->getBirthYear(), \PDO::PARAM_INT);
        $stmt->bindValue(':habitation', $student->getHabitation());
        $stmt->execute();
        return;
    }

    public function editStudent(string $token, Student $student)
    {
        $stmt = $this->pdo->prepare("UPDATE `students` SET
            `name` = :name, 
            `surname` = :surname,
            `sex` = :sex, 
            `group_number` = :group_number, 
            `email` = :email, 
            `points` = :points,  
            `birth_year` = :birth_year,
            `habitation` = :habitation
            WHERE `token` = :token");
        $stmt->bindValue(':name', $student->getName());
        $stmt->bindValue(':surname', $student->getSurname());
        $stmt->bindValue(':sex', $student->getSex());
        $stmt->bindValue(':group_number', $student->getGroupNumber());
        $stmt->bindValue(':email', $student->getEmail());
        $stmt->bindValue(':points', $student->getPoints(), \PDO::PARAM_INT);
        $stmt->bindValue(':birth_year', $student->getBirthYear(), \PDO::PARAM_INT);
        $stmt->bindValue(':habitation', $student->getHabitation());
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        return;
    }

    public function getList(
        int $limit = self::LIMIT,
        int $offset = 0,
        string $orderBy = '',
        string $orderDirection = '',
        string $searchValue = ''
    ) {
        if (!in_array($orderBy, StudentsDataGateway::ALLOWED_BY) &&  !empty($orderBy)) {
            $orderBy = StudentsDataGateway::ALLOWED_BY[0];
        }
        if (!in_array($orderDirection, StudentsDataGateway::ALLOWED_IN) && !empty($orderDirection)) {
            $orderDirection = StudentsDataGateway::ALLOWED_IN[0];
        }
        $orderStatement = !(ltrim($orderBy) == '') ? " ORDER BY " . $orderBy . " " . $orderDirection : '';
        $searchStatement = !(ltrim($searchValue) == '') ?
            " WHERE concat(name, \" \", surname, \" \", group_number, \" \", points) LIKE \"%{$searchValue}%\""
            : '';

        $stmt = $this->pdo->prepare("SELECT name, surname, group_number, points FROM `students` "
            . $searchStatement
            . $orderStatement
            . " LIMIT :offset, :limit
        ");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}