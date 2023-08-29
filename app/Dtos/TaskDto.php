<?php

namespace App\Dtos;

class TaskDto extends BaseDto
{
    /**
     * @var int $id
     * @var int $userId
     * @var string $title
     * @var string|null $description
     * @var int $status
     * @var string $dueDate
     */
    private int $id;
    private int $userId;
    private string $title;
    private ?string $description;
    private int $status;
    private string $dueDate;


    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id; 
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId; 
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title; 
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description; 
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status; 
    }

    /**
     * @param string $dueDate
     */
    public function setDueDate(string $dueDate): void
    {
        $this->dueDate = $dueDate; 
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id; 
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId; 
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title; 
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description; 
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status; 
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate; 
    }
}
