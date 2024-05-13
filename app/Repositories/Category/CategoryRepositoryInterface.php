<?php 

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{

    public function getTop(int $take, $type): Object;

}

 ?>