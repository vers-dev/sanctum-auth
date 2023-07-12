<?php

namespace App\Http\Controllers\Api\v1;

use App\Contracts\Services\AuthServiceContract;
use App\Dto\Auth\RegistrationUserDto;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\Auth\AuthTokenResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(
        private AuthServiceContract $authService
    )
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResource
     * @throws ApiException
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authService->getUserToAuth($validated['email']);

        if (!$user || !Hash::check($validated['password'], $user->password))
            throw new ApiException('The provided credentials are incorrect', 401);

        $token = $user->createToken("API TOKEN")->plainTextToken;

        return $this->successResponse(new AuthTokenResource(['token' => $token]));
    }

    /**
     * @param RegistrationRequest $request
     * @return JsonResource
     * @throws ApiException
     */
    public function registration(RegistrationRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authService->registerNewUser(new RegistrationUserDto(
            name: $validated['name'],
            email: $validated['email'],
            password: $validated['password']
        ));

        if (!$user)
            throw new ApiException('Cannot create User', 500);

        if (!Auth::attempt($request->only(['email', 'password']), true))
            throw new ApiException('User not found', 404);

        $token = $user->createToken("API TOKEN")->plainTextToken;

        return $this->successResponse(new AuthTokenResource(['token' => $token]));
    }
}
