<?php

namespace App\Usecases\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface as UserRepository;

class LoginInteractor
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserCreateInteractor constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(LoginRequest $request)
    {
        $user = $this->userRepository->getUserByEmail($request);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }
}
