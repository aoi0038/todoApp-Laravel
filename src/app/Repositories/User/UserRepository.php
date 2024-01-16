<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{    
    /**
     * @var App\Models\User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Userを新規作成する
     *
     * @return User
     */
    public function create(RegisterRequest $request): User
    {
        $user = $this->user->create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
        ]);
        return $user;
    }

    public function getUserByEmail(LoginRequest $request): User
    {
        $user = $this->user->where('email', $request['email'])->firstOrFail();
        return $user;
    }
}