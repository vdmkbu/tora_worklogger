<?php

namespace App\Modules\Project\FormRequest;

use App\Modules\Project\Dto\ProjectData;
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
            'name' => 'required|string|max:255|unique:projects',
        ];
    }

    public function toDto(): ProjectData
    {
        return new ProjectData(
            name: $this->validated('name'),
        );
    }
}
