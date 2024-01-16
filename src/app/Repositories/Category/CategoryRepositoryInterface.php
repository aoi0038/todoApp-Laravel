<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAll($userId): Collection;
    public function create(CategoryRequest $request, $userId): Category;
    public function updateById(CategoryRequest $request, Category $category): Category;
    public function deleteById(Category $category);
    public function getById($id): ?Category;
}