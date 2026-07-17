<?php

namespace App\Modules\Position\Dto;

readonly class PositionData
{
    public function __construct(
        public string $name,
    ) {}
}
