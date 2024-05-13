<?php 

namespace App\Repositories\Category;

use App\Repositories\Repository;
use App\Models\Category;
use App\Repositories\Helpers\{Filter, Search};

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{

    use Filter, Search;

    protected function getModel(): String
    {
        return Category::class;
    }

    public function getTop(int $take, $type): Object
    {
        return $this->model->when($type, function ($query) use ($type) {
            $query->whereType($type);
        })->whereHas('menus')->withCount('menus')->latest('menus_count')->take($take)->get();
    }

    public function get(string $search = null, string $type = null): Object
    {
        return $this->model
            ->where($this->searchKey ?? 'name', 'like', '%'.$search.'%')
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->get();
    }

    public function filter(string $search = null, int $take = null, string $type = null): Object
    {
        return $this->model
            ->where('name', 'like', '%'.$search.'%')
            ->when($type, function ($query) use ($type) {
                $query->whereType($type);
            })
            ->paginate($take);
    }

}

 ?>