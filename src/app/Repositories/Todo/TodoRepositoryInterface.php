<?php
namespace App\Repositories\Todo;

use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\TodoStatusRequest;
use Illuminate\Database\Eloquent\Collection;

interface TodoRepositoryInterface
{
    public function getAll($userId): Collection;
    public function create(TodoRequest $request, $userId): Todo;
    public function updateById(TodoRequest $request, Todo $todo): Todo;
    public function deleteById(Todo $todo);
    public function getById($id): ?Todo;
    public function updateStatus(TodoStatusRequest $request, Todo $todo);
}