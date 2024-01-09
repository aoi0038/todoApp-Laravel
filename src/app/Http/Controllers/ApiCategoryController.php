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
      $categories = Category::all();

      if (!$categories) {
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

      Category::create([
        'name' => $name,
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

      return response()->json([
          'category' => $category
      ], 200);
  }

}
