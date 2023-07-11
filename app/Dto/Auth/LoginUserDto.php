<?php

namespace App\Dto\Auth;

class LoginUserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    )
    {
    }

}
