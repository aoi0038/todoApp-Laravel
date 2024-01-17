<?php
namespace App\Repositories\Todo;

use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\TodoStatusRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TodoRepository implements TodoRepositoryInterface
{    
    /**
     * @var App\Models\Todo
     */
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Todoを全件取得する
     *
     * @return Collection
     */
    public function getAll($userId): Collection
    {
        return $this->todo->where('user_id', $userId)->get();
    }

    /**
     * Todoを登録する
     *
     * @param array $request
     * @return Todo
     */
    public function create(TodoRequest $request, $userId): Todo
    {
        $todoInput = $request->all();
        $name = $todoInput['name'];
        $description = $todoInput['description'];
        $category_id = $todoInput['category_id'];
        $status = $todoInput['status_id'];

        $todo = $this->todo->create([
          'name' => $name,
          'description' => $description,
          'user_id' => $userId,
          'category_id' => $category_id,
          'status_id' => $status
        ]);

        return $todo;
    }

    public function updateById(TodoRequest $request, Todo $todo): Todo
    {
        $todo->update($request->all());
        return $todo;
    }

    public function deleteById(Todo $todo): Todo
    {
        $todo->delete();
        return $todo;
    }

    public function getById($id): ?Todo
    {
        return $this->todo->find($id);
    }

    public function updateStatus(TodoStatusRequest $request, Todo $todo): Todo
    {
        $todo->update($request->all());
        return $todo;
    }

}