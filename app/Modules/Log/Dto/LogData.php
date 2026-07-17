<?php

namespace App\Modules\Log\Dto;

readonly class LogData
{
    public function __construct(
        public int $projectId,
        public string $text,
        public string $link,
        public float $time,
        public string $date,
    ) {}
}
