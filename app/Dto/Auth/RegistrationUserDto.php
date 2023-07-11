<?php

namespace App\Dto\Auth;

class RegistrationUserDto
{

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    )
    {
    }
}
