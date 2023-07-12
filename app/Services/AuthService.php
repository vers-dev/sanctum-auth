<?php

namespace App\Services;

use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Services\AuthServiceContract;
use App\Dto\Auth\RegistrationUserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\NewAccessToken;

class AuthService implements AuthServiceContract
{

    public function __construct(
        private UserRepositoryContract $userRepo
    )
    {
    }

    /**
     * @param RegistrationUserDto $dto
     * @return User
     */
    public function registerNewUser(RegistrationUserDto $dto): User
    {
        return $this->userRepo->create($dto);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserToAuth(string $email): ?User
    {
        return $this->userRepo->getByEmail($email);
    }
}
