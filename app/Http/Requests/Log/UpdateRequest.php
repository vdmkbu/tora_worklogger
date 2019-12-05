<?php

namespace App\Http\Requests\Log;

use App\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|integer|exists:projects,id',
            'text' => 'required|max:200',
            'link' => 'string|max:50',
            'time' => ['required', Rule::in(Log::timeList())],
            'date' => 'required|date'
        ];
    }
}
