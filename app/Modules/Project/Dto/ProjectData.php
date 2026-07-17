<?php

namespace App\Modules\Project\Dto;

readonly class ProjectData
{
    public function __construct(
        public string $name,
    ) {}
}
