<?php

namespace App\Modules\User\FormRequest;

use App\Modules\User\Dto\CreateUserData;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'position_id' => 'required|integer',
            'password' => 'required|string|max:255|min:8',
        ];
    }

    public function toDto(): CreateUserData
    {
        return new CreateUserData(
            name: $this->validated('name'),
            email: $this->validated('email'),
            password: $this->validated('password'),
            positionId: (int) $this->validated('position_id'),
        );
    }
}
