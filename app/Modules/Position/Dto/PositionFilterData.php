<?php

namespace App\Modules\Position\Dto;

readonly class PositionFilterData
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?string $status = null,
    ) {}
}
