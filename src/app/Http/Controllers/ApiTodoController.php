<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class ApiTodoController extends Controller
{
    public function getAll()
    {
        $todos = Todo::get();
        
        return response()->json($todos);

    }

    public function create(Request $request)
    {
        $todoInput = $request->all();
        Todo::create($todoInput);

        return response()->json($todoInput);

    }

    public function updateById(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->update($request->all());

        return response()->json($request->all());

    }

    public function deleteById($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json($todo);

    }
    public function getById(Request $request, $id)
    {
        $todo = Todo::find($id);

        return response()->json($todo);

    }
}
