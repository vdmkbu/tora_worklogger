<?php

namespace App\Modules\User\Factory;

use App\Modules\User\Dto\CreateUserData;
use App\Modules\User\Models\User;

class UserFactory
{
    /**
     * Build a new (unsaved) User from the incoming DTO.
     * Persistence is the repository's responsibility.
     */
    public function make(CreateUserData $data): User
    {
        return new User([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'position_id' => $data->positionId,
            'role' => User::ROLE_USER,
            'status' => User::STATUS_ACTIVE,
        ]);
    }
}
