<?php

namespace App\Modules\User\Dto;

readonly class CreateUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $positionId,
    ) {}
}
