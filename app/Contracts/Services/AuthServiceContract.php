<?php

namespace App\Contracts\Services;

use App\Dto\Auth\RegistrationUserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\NewAccessToken;

interface AuthServiceContract
{
    public function registerNewUser(RegistrationUserDto $dto): User;

    public function getUserToAuth(string $email): Model;


}
