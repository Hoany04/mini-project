<?php

namespace App\Services\Client;

use App\Repositories\CategoryRepository;

class ClientCategoryService
{
    protected CategoryRepository $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getCategoriesForFilter()
    {
        return $this->categoryRepo->getCategoriesWithProductCount();
    }

    public function getCategoryData($slug)
    {
        // Lấy danh mục hiện tại
        $category = $this->categoryRepo->findBySlug($slug);

        // Lấy ID danh mục con (nếu có)
        $childrenIds = $this->categoryRepo->getChildrenIds($category);

        // Gom danh sách ID
        $categoryIds = array_merge([$category->id], $childrenIds);

        // Lấy sản phẩm thuộc các danh mục này
        $products = $this->categoryRepo->getProductsByCategoryIds($categoryIds);

        // Lấy danh sách tất cả danh mục cha + con để hiển thị menu
        $categories = $this->categoryRepo->getAllParentCategoriesWithChildren();

        return compact('categories', 'products', 'category');
    }
}
