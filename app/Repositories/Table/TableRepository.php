<?php 

namespace App\Repositories\Table;

use App\Repositories\Repository;
use App\Models\Table;
use App\Repositories\Helpers\{Filter};

class TableRepository extends Repository implements TableRepositoryInterface
{

    use Filter;

    protected $filterKey = 'no';

    protected function getModel(): String
    {
        return Table::class;
    }

    public function get(): Object
    {
        return $this->model->countOrder()->withOrder()->get();
    }

    public function filter(string $search = null, int $take = null, string $orderBy = 'created_at', string $orderDir = 'desc'): Object
    {
        return $this->model->where($this->filterKey ?? 'name', 'like', '%'.$search.'%')->countOrder()->withOrder()->paginate($take);
    }

    public function searchHasOrder(string $search = null): Object
    {
        return $this->model->where('no', 'like', '%'.$search.'%')->has('orders')->get();
    }

    public function searchInactive(string $search = null): Object
    {
        return $this->model->where('no', 'like', '%'.$search.'%')->whereDoesntHave('orders', function ($query)
        {
            return $query->where('status', 'active')->orWhere('status', 'pending');
        })->get();
    }

    public function searchAll(string $search = null): Object
    {
        return $this->model->where('no', 'like', '%'.$search.'%')->get();
    }

}

 ?>