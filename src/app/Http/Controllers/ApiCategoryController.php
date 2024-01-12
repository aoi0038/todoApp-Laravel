<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class ApiCategoryController extends Controller
{
  public function getAll()
  {
      $userId = Auth::id();
      $categories = Category::where('user_id', $userId)->get();

      if ($categories->isEmpty()) {
        return response()->json([
            'message' => 'categoryが見つかりません'
        ], 404);
      }

      return response()->json([
          'categories' => $categories
      ], 200);
  }

  public function create(CategoryRequest $request)
  {
      $categoryInput = $request->all();
      $name = $categoryInput['name'];
      $userId = $categoryInput['user_id'];

      Category::create([
        'name' => $name,
        'user_id' => $userId,
      ]);

      return response()->json($categoryInput);
  }

  public function updateById(CategoryRequest $request, $id)
  {
      $category = Category::find($id);

      if (is_null($category)) {
        return response()->json([
            'message' => 'categoryが見つかりません'
        ], 404);
      }
      $category->update($request->all());
      return response()->json($request->all());
  }

  public function deleteById($id)
  {
      $category = Category::find($id);

      if (is_null($category)) {
        return response()->json([
            'message' => 'categoryが見つかりません'
        ], 404);
      }

      $authUserId = Auth::id();
      $userId = $category['user_id'];
      if ($authUserId !== $userId) {
        return response()->json([
            'message' => '認証に失敗しました'
        ], 401);
      }

      $category->delete();
      return response()->json($category);
  }

  public function getById($id)
  {
      $category = Category::find($id);
      if (!$category) {
        return response()->json([
            'message' => 'categoryが見つかりません'
        ], 404);
      }

      $authUserId = Auth::id();
      $userId = $category['user_id'];
      if ($authUserId !== $userId) {
        return response()->json([
            'message' => '認証に失敗しました'
        ], 401);
      }

      return response()->json([
          'category' => $category
      ], 200);
  }

}
