<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\TodoStatusRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Todo\TodoRepositoryInterface as TodoRepository;
use App\Usecases\Todo\GetAllInteractor;
use App\Usecases\Todo\CreateInteractor;
use App\Usecases\Todo\UpdateByIdInteractor;
use App\Usecases\Todo\DeleteByIdInteractor;
use App\Usecases\Todo\GetByIdInteractor;
use App\Usecases\Todo\UpdateStatusInteractor;

class ApiTodoController extends Controller
{
  /**
   * @var TodoRepository
   */
    private $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getAll()
    {
        $getAllInteractor = new GetAllInteractor($this->todoRepository);
        $todos = $getAllInteractor->handle();

        if ($todos->isEmpty()) {
          return response()->json([
              'message' => 'todoが見つかりません'
          ], 404);
        }

        return response()->json([
            'todos' => $todos
        ], 200);
    }

    public function create(TodoRequest $request)
    {
        $createInteractor = new CreateInteractor($this->todoRepository);
        $todo = $createInteractor->handle($request);
        return response()->json($todo);
    }

    public function updateById(TodoRequest $request, $id)
    {
        $updateByIdInteractor = new UpdateByIdInteractor($this->todoRepository);
        $response = $updateByIdInteractor->handle($request, $id);

        if ($response === 404) {
            return response()->json([
              'message' => 'todoが見つかりません'
            ], 404);
        }
        if ($response === 401) {
            return response()->json([
              'message' => '認証に失敗しました'
            ], 401);
        }
        return $response;
    }

    public function deleteById($id)
    {
        $deleteByIdInteractor = new DeleteByIdInteractor($this->todoRepository);
        $response = $deleteByIdInteractor->handle($id);

        if ($response === 404) {
            return response()->json([
              'message' => 'todoが見つかりません'
            ], 404);
        }
        if ($response === 401) {
            return response()->json([
              'message' => '認証に失敗しました'
            ], 401);
        }
        return $response;
    }
    
    public function getById($id)
    {
        $getByIdInteractor = new GetByIdInteractor($this->todoRepository);
        $response = $getByIdInteractor->handle($id);

        if ($response === 404) {
            return response()->json([
              'message' => 'todoが見つかりません'
            ], 404);
        }
        if ($response === 401) {
            return response()->json([
              'message' => '認証に失敗しました'
            ], 401);
        }
        return response()->json([
            'todo' => $response
        ], 200);
    }

    public function updateStatus(TodoStatusRequest $request, $id)
    {
        $updateStatusInteractor = new UpdateStatusInteractor($this->todoRepository);
        $response = $updateStatusInteractor->handle($request, $id);

        if ($response === 404) {
            return response()->json([
              'message' => 'todoが見つかりません'
            ], 404);
        }
        if ($response === 401) {
            return response()->json([
              'message' => '認証に失敗しました'
            ], 401);
        }
        return response()->json($response);
    }
}
