<?php

namespace App\Usecases\Todo;

use App\Repositories\Todo\TodoRepositoryInterface as TodoRepository;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class DeleteByIdInteractor
{
    /**
     * @var TodoRepositoryInterface
     */
    private $todoRepository;

    /**
     * UserCreateInteractor constructor.
     * @param TodoRepository $todoRepository
     */
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function handle($id)
    {
        $todo = $this->todoRepository->getById($id);

        if (is_null($todo)) return 404;

        $authUserId = Auth::id();
        $userId = $todo['user_id'];
        if ($authUserId !== $userId) return 401;
        
        $this->todoRepository->deleteById($todo);
        return $todo;
    }
}
