<?php

namespace Students\Controllers;

class ListOutputController
{
    private $container;
    private $studentsDataGateway;

    public function __construct(\Students\DIContainer $container)
    {
        $this->container = $container;
        $this->studentsDataGateway = $this->container->get('studentsDataGateway');
    }

    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            header("HTTP/1.0 404 Not Found");
            include_once('../../templates/error.php');
            die();
        }

        $search = strval($_GET['search'] ?? null);
        $page = intval($_GET['page'] ?? 1);
        $orderBy = strval($_GET['by'] ?? null);
        $orderDirection = strval($_GET['in'] ?? null);

        $offset = (($page - 1) * $this->studentsDataGateway::LIMIT);
        $studentData = $this->studentsDataGateway->getList(
            $this->studentsDataGateway::LIMIT,
            $offset,
            $orderBy,
            $orderDirection,
            $search
        );

        $rowsCount = $this->studentsDataGateway->getStudentsCount($search);
        $listOutputHelper = new \Students\ListOutputHelper($search, $orderBy, $orderDirection, $rowsCount, $page);
        $this->render($studentData, $listOutputHelper);
    }

    private function render(array $studentData, \Students\ListOutputHelper $listOutputHelper)
    {
        require_once('../templates/students-list.php');
    }
}