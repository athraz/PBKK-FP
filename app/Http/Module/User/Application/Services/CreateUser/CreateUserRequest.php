<?php

namespace App\Http\Module\User\Application\Services\CreateUser;

class CreateUserRequest
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    )
    {
    }
}