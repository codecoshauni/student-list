<?php

namespace Students;

use Students\Model\StudentsDataGateway;

class ListOutputHelper
{
    private $search;
    private $orderBy;
    private $orderDirection;
    private $rowsCount;
    private $page;

    public function __construct(string $search, string $orderBy, string $orderDirection, int $rowsCount, int $page)
    {
        $this->search = ($search == '') ? null : $search;
        $this->orderBy = ($orderBy == '') ? null : $orderBy;
        $this->orderDirection = ($orderDirection == '') ? null : $orderDirection;
        $this->rowsCount = $rowsCount;
        $this->page = $page;
    }

    public function getSortingLink(string $column)
    {
        $direction = ($this->orderBy == $column && $this->orderDirection == 'asc') ? 'desc' : 'asc';
        $params = array(
            'by' => $column,
            'in' => $direction,
            'search' => $this->search
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
            'by' => $this->orderBy,
            'in' => $this->orderDirection,
            'search' => $this->search,
            'page' => $page
        );
        return '/?' . http_build_query($params);
    }

    public function markSearchValue($tablevalue)
    {
        if (!$this->search) return $tablevalue;

        $searchValues = explode(' ', $this->search);
        foreach ($searchValues as $searchValue) {
            $start = mb_stripos($tablevalue, $searchValue);
            if ($start !== false) {
                $tablevalue = htmlspecialchars(mb_substr($tablevalue, 0, $start))
                    . '<mark>'
                    . htmlspecialchars(mb_substr($tablevalue, $start, mb_strlen($searchValue)))
                    . '</mark>'
                    . htmlspecialchars(mb_substr($tablevalue, $start + mb_strlen($searchValue)));
                break;
            }
        }

        return $tablevalue;
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

    public function getPage()
    {
        return $this->page;
    }
}