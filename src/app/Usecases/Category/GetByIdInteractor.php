<?php

namespace App\Usecases\Category;

use App\Repositories\Category\CategoryRepositoryInterface as CategoryRepository;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class GetByIdInteractor
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

    public function handle($id)
    {
        $category = $this->categoryRepository->getById($id);

        if (!$category) return 404;

        $authUserId = Auth::id();
        $userId = $category['user_id'];
        if ($authUserId !== $userId) return 401;
        
        return $category;
    }
}
