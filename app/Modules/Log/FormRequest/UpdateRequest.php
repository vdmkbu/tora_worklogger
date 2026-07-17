<?php

namespace App\Modules\Log\FormRequest;

use App\Modules\Log\Dto\LogData;
use App\Modules\Log\Models\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => 'required|integer|exists:projects,id',
            'text' => 'required|max:200',
            'link' => 'nullable|string|max:50',
            'time' => ['required', Rule::in(Log::timeList())],
            'date' => 'required|date',
        ];
    }

    public function toDto(): LogData
    {
        return new LogData(
            projectId: (int) $this->validated('project_id'),
            text: $this->validated('text'),
            link: $this->validated('link') ?? '',
            time: (float) $this->validated('time'),
            date: $this->validated('date'),
        );
    }
}
