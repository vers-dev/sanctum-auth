<?php

namespace App\Contracts\Repository;

use App\Dto\Auth\RegistrationUserDto;
use App\Models\User;

interface UserRepositoryContract
{

    /**
     * @param RegistrationUserDto $dto
     * @return User
     */
    public function create(RegistrationUserDto $dto): User;

    /**
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User;
}
