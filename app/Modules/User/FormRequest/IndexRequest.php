<?php

namespace App\Modules\User\FormRequest;

use App\Modules\User\Dto\UserFilterData;
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
            'email' => 'nullable|string',
            'status' => 'nullable|string',
            'role' => 'nullable|string',
        ];
    }

    public function toDto(): UserFilterData
    {
        return new UserFilterData(
            id: $this->filled('id') ? (int) $this->query('id') : null,
            name: $this->query('name') ?: null,
            email: $this->query('email') ?: null,
            status: $this->query('status') ?: null,
            role: $this->query('role') ?: null,
        );
    }
}
