<?php

namespace App\Modules\Project\FormRequest;

use App\Modules\Project\Dto\ProjectFilterData;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|integer',
            'name' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }

    public function toDto(): ProjectFilterData
    {
        return new ProjectFilterData(
            id: $this->filled('id') ? (int) $this->query('id') : null,
            name: $this->query('name') ?: null,
            status: $this->query('status') ?: null,
        );
    }
}
