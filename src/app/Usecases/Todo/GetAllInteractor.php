<?php

namespace App\Usecases\Todo;

use App\Repositories\Todo\TodoRepositoryInterface as TodoRepository;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class GetAllInteractor
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
     * @return Collection
     */
    public function handle(): Collection
    {
        $userId = Auth::id();
        $todos = $this->todoRepository->getAll($userId);

        return $todos;
    }
}
