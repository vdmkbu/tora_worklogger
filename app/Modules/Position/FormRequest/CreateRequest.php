<?php

namespace App\Modules\Position\FormRequest;

use App\Modules\Position\Dto\PositionData;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:positions',
        ];
    }

    public function toDto(): PositionData
    {
        return new PositionData(
            name: $this->validated('name'),
        );
    }
}
