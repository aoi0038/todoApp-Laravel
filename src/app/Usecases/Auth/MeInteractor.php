<?php

namespace App\Usecases\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface as UserRepository;

class MeInteractor
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

    public function handle(Request $request)
    {
        return $request->user();
    }
}
