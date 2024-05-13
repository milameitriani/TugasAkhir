<?php 

namespace App\Repositories\Table;

interface TableRepositoryInterface
{

    public function searchHasOrder(string $search = null): Object;

    public function searchInactive(string $search = null): Object;

}

 ?>