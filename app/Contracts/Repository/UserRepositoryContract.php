<?php

namespace App\Contracts\Repository;

use App\Dto\Auth\RegistrationUserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryContract
{

    public function create(RegistrationUserDto $dto): Model;

    public function getByEmail(string $email): ?User;
}
