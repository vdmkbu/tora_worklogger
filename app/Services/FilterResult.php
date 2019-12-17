<?php

namespace App\Services;

use Illuminate\Database\Query\Builder;

class FilterResult
{
    public $query;
    public $interval;

    public function __construct(Builder $query, array $interval)
    {
        $this->query = $query;
        $this->interval = $interval;
    }
}