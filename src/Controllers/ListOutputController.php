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
            include_once('../../templates/error.html');
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
        $linksService = new \Students\LinksService($search, $orderBy, $orderDirection, $rowsCount);
        $this->render($studentData, $linksService);
    }

    private function render(array $studentData, \Students\LinksService $linksService)
    {
        require_once('../templates/students-list.php');
    }
}