<?php

namespace App\Dto;

class AuthUserDto
{

    public function __construct(
        public readonly int    $id,
        public readonly string $email,
        public readonly string $emailVerifiedAt,
        public readonly string $name,
        public readonly string $token
    )
    {
    }

}
