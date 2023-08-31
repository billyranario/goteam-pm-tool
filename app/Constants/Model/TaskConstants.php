<?php

namespace App\Constants\Model;

use Illuminate\Support\Arr;

class TaskConstants
{
    /**
     * @var int TODO_ID
     * @var int IN_PROGRESS_ID
     * @var int DONE_ID
     * @var int ARCHIVE_ID
     */
    const TODO_ID = 0;
    const IN_PROGRESS_ID = 1;
    const DONE_ID = 2;
    const ARCHIVE_ID = 9; 

    /**
     * @var array STATUSES
     */
    const STATUSES = [
        self::TODO_ID => 'Todo',
        self::IN_PROGRESS_ID => 'In-progress',
        self::DONE_ID => 'Done',
        self::ARCHIVE_ID => 'Archived',
    ];

    /**
     * @param int $statusId
     * @return string
     */
    public function getLabel(int $statusId = 0): string
    {
        return Arr::get(self::STATUSES, $statusId, '');
    }
}