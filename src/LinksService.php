<?php

namespace Students;

use Students\Model\StudentsDataGateway;

class LinksService
{
    private $search;
    private $orderBy;
    private $orderDirection;
    private $rowsCount;

    public function __construct(string $search, string $orderBy, string $orderDirection, int $rowsCount)
    {
        $this->search = ($search == '') ? null : $search;
        $this->orderBy = ($orderBy == '') ? null : $orderBy;
        $this->orderDirection = ($orderDirection == '') ? null : $orderDirection;
        $this->rowsCount = $rowsCount;
    }

    public function getSortingLink(string $column)
    {
        $direction = ($this->orderBy == $column && $this->orderDirection == 'asc') ? 'desc' : 'asc';
        $params = array(
            'search' => $this->search,
            'by' => $column,
            'in' => $direction
        );
        return '/?' . http_build_query($params);
    }

    public function getPagesCount(int $limit = null)
    {
        if (is_null($limit)) $limit = StudentsDataGateway::LIMIT;
        return ceil($this->rowsCount / $limit);
    }

    public function getPageLink(int $page)
    {
        $params = array(
            'search' => $this->search,
            'by' => $this->orderBy,
            'in' => $this->orderDirection,
            'page' => $page
        );
        return '/?' . http_build_query($params);
    }

    public function getOrderBy()
    {
        return $this->orderBy;
    }

    public function getOrderDirection()
    {
        return $this->orderDirection;
    }

    public function getSearch()
    {
        return $this->search;
    }
}