<?php

namespace App\Modules\Position\FormRequest;

use App\Modules\Position\Dto\PositionFilterData;
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

    public function toDto(): PositionFilterData
    {
        return new PositionFilterData(
            id: $this->filled('id') ? (int) $this->query('id') : null,
            name: $this->query('name') ?: null,
            status: $this->query('status') ?: null,
        );
    }
}
