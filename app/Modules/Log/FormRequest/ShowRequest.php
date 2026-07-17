<?php

namespace App\Modules\Log\FormRequest;

use App\Modules\Log\Dto\LogFilterData;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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
            'text' => 'nullable|string',
            'project' => 'nullable|integer',
        ];
    }

    public function toDto(int $userId): LogFilterData
    {
        return new LogFilterData(
            userId: $userId,
            fromDate: $this->query('from_date') ?: null,
            toDate: $this->query('to_date') ?: null,
            text: $this->query('text') ?: null,
            projectId: $this->filled('project') ? (int) $this->query('project') : null,
        );
    }
}
