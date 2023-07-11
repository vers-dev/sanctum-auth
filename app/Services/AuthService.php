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

    public function registerNewUser(RegistrationUserDto $dto): User
    {
        return $this->userRepo->create($dto);
    }

    public function getUserToAuth(string $email): Model
    {
        return $this->userRepo->getByEmail($email);
    }
}
