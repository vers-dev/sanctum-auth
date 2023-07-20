<?php

namespace App\Contracts\Services;

use App\Dto\Auth\RegistrationUserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\NewAccessToken;

interface AuthServiceContract
{
    /**
     * @param RegistrationUserDto $dto
     * @return User
     */
    public function registerNewUser(RegistrationUserDto $dto): User;

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserToAuth(string $email): ?User;


}
