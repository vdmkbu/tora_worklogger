<?php

namespace App\Modules\Report\Dto;

use Carbon\Carbon;

readonly class DateFilterData
{
    public function __construct(
        public ?string $fromDate = null,
        public ?string $toDate = null,
    ) {}

    /**
     * Human-readable interval (start/end) for the report header.
     * Pure computation, no DB access.
     *
     * @return array{start: string, end: string}
     */
    public function interval(): array
    {
        if (empty($this->fromDate) && empty($this->toDate)) {
            return [
                'start' => (new Carbon('first day of this month'))->format('Y.m.d'),
                'end' => (new Carbon('last day of this month'))->format('Y.m.d'),
            ];
        }

        if (! empty($this->fromDate) && ! empty($this->toDate)) {
            return [
                'start' => (new Carbon($this->fromDate))->format('Y.m.d'),
                'end' => (new Carbon($this->toDate))->format('Y.m.d'),
            ];
        }

        if (! empty($this->fromDate)) {
            return [
                'start' => (new Carbon($this->fromDate))->format('Y.m.d'),
                'end' => (new Carbon)->format('Y.m.d'),
            ];
        }

        return [
            'start' => '',
            'end' => (new Carbon($this->toDate))->format('Y.m.d'),
        ];
    }
}
