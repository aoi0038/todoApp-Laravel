<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiTodoController extends Controller
{
    public function getAll()
    {
        $userId = Auth::id();
        $todos = Todo::where('user_id', $userId)->get();

        if ($todos->isEmpty()) {
          return response()->json([
              'message' => 'todoが見つかりません'
          ], 404);
        }

        return response()->json([
            'todos' => $todos
        ], 200);

    }

    public function create(Request $request)
    {
        $userId = Auth::id();
        $todoInput = $request->all();
        $name = $todoInput['name'];
        $description = $todoInput['description'];
        $category_id = $todoInput['category_id'];

        Todo::create([
          'name' => $name,
          'description' => $description,
          'user_id' => $userId,
          'category_id' => $category_id,
        ]);

        return response()->json($todoInput);

    }

    public function updateById(Request $request, $id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) {
          return response()->json([
              'message' => 'todoが見つかりません'
          ], 404);
        }
        $authUserId = Auth::id();
        $userId = $todo['user_id'];
        if ($authUserId !== $userId) {
          return response()->json([
              'message' => '認証に失敗しました'
          ], 401);
        }
        $todo->update($request->all());
        return response()->json($request->all());

    }

    public function deleteById($id)
    {
        $todo = Todo::find($id);

        if (is_null($todo)) {
          return response()->json([
              'message' => 'todoが見つかりません'
          ], 404);
        }
        $authUserId = Auth::id();
        $userId = $todo['user_id'];
        if ($authUserId !== $userId) {
          return response()->json([
              'message' => '認証に失敗しました'
          ], 401);
        }
        $todo->delete();
        return response()->json($todo);

    }
    public function getById(Request $request, $id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
          return response()->json([
              'message' => 'todoが見つかりません'
          ], 404);
        }
        $authUserId = Auth::id();
        $userId = $todo['user_id'];
        if ($authUserId !== $userId) {
          return response()->json([
              'message' => '認証に失敗しました'
          ], 401);
        }

        return response()->json([
            'todo' => $todo
        ], 200);

    }

    public function updateStatus(Request $request, $id)
    {
        $todo = Todo::find($id);
        if (is_null($todo)) {
          return response()->json([
              'message' => 'todoが見つかりません'
          ], 404);
        }
        $authUserId = Auth::id();
        $userId = $todo['user_id'];
        if ($authUserId !== $userId) {
          return response()->json([
              'message' => '認証に失敗しました'
          ], 401);
        }
        $todo->update($request->all());
        return response()->json($request->all());

    }
}
