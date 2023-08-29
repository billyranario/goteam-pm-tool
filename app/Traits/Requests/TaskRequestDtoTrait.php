<?php

namespace App\Traits\Requests;

use App\Dtos\TaskDto;

trait TaskRequestDtoTrait
{

    /**
     * Transform request to data transfer object.
     * @return TaskDto
     */
    public function toDto(): TaskDto
    {
        $taskDto = new TaskDto();
        $taskDto->setId($this->getInputAsInt('id'));
        $taskDto->setUserId(auth()->id());
        $taskDto->setTitle($this->getInputAsString('title'));
        $taskDto->setStatus($this->getInputAsInt('status'));
        $taskDto->setDueDate($this->getInputAsString('dueDate'));
        $taskDto->setDescription($this->getInputAsString('description'));
        
        if (!empty($this->getInputAsString('search'))) {
            $taskDto->setSearchKeyword($this->getInputAsString('search'));
        }
        if (!empty($this->getInputAsInt('perPage'))) {
            $taskDto->setPerPage($this->getInputAsInt('perPage'));
        }
        if (!empty($this->getInputAsString('orderBy'))) {
            $taskDto->setOrderBy($this->getInputAsString('orderBy'));
        }
        if (!empty($this->getInputAsString('orderDirection'))) {
            $taskDto->setOrderDirection($this->getInputAsString('orderDirection'));
        }
        if (!empty($this->getInputAsArrayFromCommaSeparatedString('relations'))) {
            $taskDto->setRelations($this->getInputAsArrayFromCommaSeparatedString('relations'));
        }

        return $taskDto;
    }
}
