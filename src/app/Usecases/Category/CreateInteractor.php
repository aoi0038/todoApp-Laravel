<?php

namespace App\Usecases\Category;

use App\Repositories\Category\CategoryRepositoryInterface as CategoryRepository;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CreateInteractor
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * UserCreateInteractor constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Category
     */
    public function handle(CategoryRequest $request): Category
    {
        $userId = Auth::id();
        $category = $this->categoryRepository->create($request, $userId);
        return $category;
    }
}
