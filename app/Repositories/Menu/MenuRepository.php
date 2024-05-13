<?php 

namespace App\Repositories\Menu;

use App\Repositories\Repository;
use App\Models\Menu;
use App\Repositories\Helpers\{Filter, Search};

class MenuRepository extends Repository implements MenuRepositoryInterface
{

    use Filter;

    protected $filterRelation = ['category'];

    protected function getModel(): String
    {
        return Menu::class;
    }

    public function filterByCategory(string $search = null, int $category = null): Object
    {
        return $this->model->where('name', 'like', '%'.$search.'%')->when($category, function ($query) use ($category)
        {
            return $query->where('category_id', $category);
        })->with($this->filterRelation)->latest()->paginate(6);
    }

    public function filter(string $search = null, string $type = null, int $category = null, int $take = 6): Object
    {
        return $this->model->where('name', 'like', '%'.$search.'%')->when($category, function ($query) use ($category)
        {
            return $query->where('category_id', $category);
        })->when($type, function ($query) use ($type)
        {
            return $query->where('type', $type);
        })->with($this->filterRelation)->latest()->paginate($take);
    }

    public function find(int $id): Object
    {
        return $this->model->with($this->filterRelation)->findOrFail($id);
    }

    public function countFood() : int {
        return $this->model->whereType('food')->count();
    }

    public function countDrink() : int {
        return $this->model->whereType('drink')->count();
    }

}

 ?>