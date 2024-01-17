<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryStatusRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{    
    /**
     * @var App\Models\Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Categoryを全件取得する
     *
     * @return Collection
     */
    public function getAll($userId): Collection
    {
        return $this->category->where('user_id', $userId)->get();
    }

    /**
     * Categoryを登録する
     *
     * @param array $request
     * @return Category
     */
    public function create(CategoryRequest $request, $userId): Category
    {
        $categoryInput = $request->all();
        $name = $categoryInput['name'];

        $category = $this->category->create([
          'name' => $name,
          'user_id' => $userId,
        ]);

        return $category;
    }

    public function updateById(CategoryRequest $request, Category $category): Category
    {
        $category->update($request->all());
        return $category;
    }

    public function deleteById(Category $category): Category
    {
        $category->delete();
        return $category;
    }

    public function getById($id): ?Category
    {
        return $this->category->find($id);
    }
}