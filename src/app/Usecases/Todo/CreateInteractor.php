<?php

namespace App\Usecases\Todo;

use App\Repositories\Todo\TodoRepositoryInterface as TodoRepository;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class CreateInteractor
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

    /**
     * @return Todo
     */
    public function handle(TodoRequest $request): Todo
    {
        $userId = Auth::id();
        $todo = $this->todoRepository->create($request, $userId);
        return $todo;
    }
}
