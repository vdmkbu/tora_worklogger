<?php

namespace App\Modules\Log\Dto;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

readonly class LogListResult
{
    public function __construct(
        public LengthAwarePaginator $logs,
        public float $timeTotal,
    ) {}
}
