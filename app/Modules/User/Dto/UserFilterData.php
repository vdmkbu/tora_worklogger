<?php

namespace App\Modules\User\Dto;

readonly class UserFilterData
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $status = null,
        public ?string $role = null,
    ) {}
}
