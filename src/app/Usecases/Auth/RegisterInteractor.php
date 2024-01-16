<?php

namespace App\Usecases\Auth;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface as UserRepository;

class RegisterInteractor
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

    public function handle(RegisterRequest $request)
    {
        $user = $this->userRepository->create($request);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }
}
