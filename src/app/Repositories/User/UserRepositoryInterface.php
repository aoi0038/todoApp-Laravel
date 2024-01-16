<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function create(RegisterRequest $request): User;
    public function getUserByEmail(LoginRequest $request): User;
}