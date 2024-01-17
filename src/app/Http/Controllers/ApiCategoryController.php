<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Category\CategoryRepositoryInterface as CategoryRepository;
use App\Usecases\Category\GetAllInteractor;
use App\Usecases\Category\CreateInteractor;
use App\Usecases\Category\UpdateByIdInteractor;
use App\Usecases\Category\DeleteByIdInteractor;
use App\Usecases\Category\GetByIdInteractor;

class ApiCategoryController extends Controller
{
  /**
   * @var CategoryRepository
   */
  private $categoryRepository;

  public function __construct(CategoryRepository $categoryRepository)
  {
      $this->categoryRepository = $categoryRepository;
  }

  public function getAll()
  {
      $getAllInteractor = new GetAllInteractor($this->categoryRepository);
      $categories = $getAllInteractor->handle();

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
      $createInteractor = new CreateInteractor($this->categoryRepository);
      $category = $createInteractor->handle($request);
      return response()->json($category);
  }

  public function updateById(CategoryRequest $request, $id)
  {
      $updateByIdInteractor = new UpdateByIdInteractor($this->categoryRepository);
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
      $deleteByIdInteractor = new DeleteByIdInteractor($this->categoryRepository);
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
      $getByIdInteractor = new GetByIdInteractor($this->categoryRepository);
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
      if (!$category) {
        return response()->json([
            'message' => 'categoryが見つかりません'
        ], 404);
      }
  }

}
