<?php

namespace App\Modules\Log\Dto;

readonly class LogFilterData
{
    public function __construct(
        public int $userId,
        public ?string $fromDate = null,
        public ?string $toDate = null,
        public ?string $text = null,
        public ?int $projectId = null,
    ) {}
}
