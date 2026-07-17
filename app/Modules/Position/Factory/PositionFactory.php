<?php

namespace App\Modules\Position\Factory;

use App\Modules\Position\Dto\PositionData;
use App\Modules\Position\Models\Position;

class PositionFactory
{
    public function make(PositionData $data): Position
    {
        return new Position([
            'name' => $data->name,
            'status' => Position::STATUS_ACTIVE,
        ]);
    }
}
