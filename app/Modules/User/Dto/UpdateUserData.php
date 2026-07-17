<?php

namespace App\Modules\User\Dto;

readonly class UpdateUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public int $positionId,
        public string $role,
    ) {}
}
