<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface as UserRepository;
use App\Usecases\Auth\RegisterInteractor;
use App\Usecases\Auth\LoginInteractor;
use App\Usecases\Auth\MeInteractor;

class AuthController extends Controller
{
  /**
   * @var UserRepository
   */
  private $userRepository;

  public function __construct(UserRepository $userRepository)
  {
      $this->userRepository = $userRepository;
  }

  public function register(RegisterRequest $request)
  {
    $registerInteractor = new RegisterInteractor($this->userRepository);
    $token = $registerInteractor->handle($request);

    return response()->json([
      'access_token' => $token,
      'token_type' => 'Bearer',
    ]);
  }
  
  public function login(LoginRequest $request)
  {
    if (!Auth::attempt($request->only('email', 'password'))) {
      return response()->json([
        'message' => 'Invalid login details'
      ], 401);
    }
    $registerInteractor = new LoginInteractor($this->userRepository);
    $token = $registerInteractor->handle($request);

    return response()->json([
      'access_token' => $token,
      'token_type' => 'Bearer',
    ]);
  }

  public function me(Request $request)
  {
    $meInteractor = new MeInteractor($this->userRepository);
    $response = $meInteractor->handle($request);
    return $response;
  }

}
