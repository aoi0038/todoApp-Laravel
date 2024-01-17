<?php

namespace App\Usecases\Todo;

use App\Repositories\Todo\TodoRepositoryInterface as TodoRepository;
use App\Models\Todo;
use App\Http\Requests\TodoStatusRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class UpdateStatusInteractor
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

    public function handle(TodoStatusRequest $request, $id)
    {
        $todoStatus = $this->todoRepository->getById($id);

        if (is_null($todoStatus)) return 404;

        $authUserId = Auth::id();
        $userId = $todoStatus['user_id'];
        if ($authUserId !== $userId) return 401;
        
        $todoStatusUpdated = $this->todoRepository->updateStatus($request, $todoStatus);
        return $todoStatusUpdated;
    }
}
