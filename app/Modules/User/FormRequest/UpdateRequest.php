<?php

namespace App\Modules\User\FormRequest;

use App\Modules\User\Dto\UpdateUserData;
use App\Modules\User\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property User $user
 */
class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'position_id' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->user->id,
            'role' => 'required|string|in:'.implode(',', array_keys(User::rolesList())),
        ];
    }

    public function toDto(): UpdateUserData
    {
        return new UpdateUserData(
            name: $this->validated('name'),
            email: $this->validated('email'),
            positionId: (int) $this->validated('position_id'),
            role: $this->validated('role'),
        );
    }
}
