<?php

namespace App\Repository;

use App\Contracts\Repository\UserRepositoryContract;
use App\Dto\Auth\RegistrationUserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class UserRepository implements UserRepositoryContract
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @param RegistrationUserDto $dto
     * @return User
     */
    public function create(RegistrationUserDto $dto): User
    {
        return $this->model->query()->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password)
        ]);
    }

    /**
     * @param string $email
     * @return Model
     */
    public function getByEmail(string $email): Model
    {
        return $this->model->query()->where('email', $email)->first();
    }
}
