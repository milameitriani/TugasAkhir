<?php 

namespace App\Repositories\Helpers;

trait Filter
{

    public function filter(string $search = null, int $take = null, string $orderBy = 'created_at', string $orderDir = 'desc'): Object
    {
        return $this->model->where($this->filterKey ?? 'name', 'like', '%'.$search.'%')->with($this->filterRelation ?? [])->orderBy($orderBy, $orderDir)->paginate($take);
    }

}

 ?>