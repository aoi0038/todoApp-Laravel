<?php

namespace App\Usecases\Category;

use App\Repositories\Category\CategoryRepositoryInterface as CategoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class GetAllInteractor
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
     * @return Collection
     */
    public function handle(): Collection
    {
        $userId = Auth::id();
        $categories = $this->categoryRepository->getAll($userId);

        return $categories;
    }
}
