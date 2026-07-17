<?php

namespace App\Modules\Log\Factory;

use App\Modules\Log\Dto\LogData;
use App\Modules\Log\Models\Log;
use App\Modules\User\Models\User;

class LogFactory
{
    /**
     * Build a new (unsaved) Log for the given user from the incoming DTO.
     * Persistence is the repository's responsibility.
     */
    public function make(User $user, LogData $data): Log
    {
        return new Log([
            'user_id' => $user->id,
            'project_id' => $data->projectId,
            'text' => $data->text,
            'link' => $data->link,
            'time' => $data->time,
            'date' => $data->date,
        ]);
    }
}
