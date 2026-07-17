<?php

namespace App\Modules\Project\Dto;

readonly class ProjectFilterData
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?string $status = null,
    ) {}
}
