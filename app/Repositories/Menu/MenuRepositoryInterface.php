<?php 

namespace App\Repositories\Menu;

interface MenuRepositoryInterface
{

    public function filterByCategory(string $search = null, int $category = null): Object;

}

 ?>