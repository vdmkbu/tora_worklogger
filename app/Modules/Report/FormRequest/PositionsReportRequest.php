<?php

namespace App\Modules\Report\FormRequest;

use App\Modules\Report\Dto\DateFilterData;
use Illuminate\Foundation\Http\FormRequest;

class PositionsReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'position' => 'nullable|integer',
        ];
    }

    public function toDto(): DateFilterData
    {
        return new DateFilterData(
            fromDate: $this->query('from_date') ?: null,
            toDate: $this->query('to_date') ?: null,
        );
    }

    public function positionId(): ?int
    {
        return $this->filled('position') ? (int) $this->query('position') : null;
    }
}
