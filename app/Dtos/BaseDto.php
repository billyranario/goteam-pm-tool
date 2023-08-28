<?php

namespace App\Dtos;

class BaseDto
{
    /**
     * @var int $perPage
     * @var int $page
     * @var string $orderBy
     * @var string $orderDirection
     * @var string $searchKeyword
     */

    private int $perPage = 10;
    private int $page = 1;
    private string $orderBy = 'created_at';
    private string $orderDirection = 'desc';
    private ?string $searchKeyword;

    /**
     * @param int $perPage
     */
    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @param string $orderDirection
     */
    public function setOrderDirection(string $orderDirection): void
    {
        $this->orderDirection = $orderDirection;
    }

    /**
     * @param string $searchKeyword
     */
    public function setSearchKeyword(string $searchKeyword): void
    {
        $this->searchKeyword = $searchKeyword;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @return string
     */
    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }

    /**
     * @return string
     */
    public function getSearchKeyword(): ?string
    {
        return $this->searchKeyword;
    }
}
