<?php 

namespace App\Repositories\Helpers;

trait Search
{

    public function search(string $search = null): Object
    {
        return $this->model->where($this->searchKey ?? 'name', 'like', '%'.$search.'%')->get();
    }

}

 ?>