<?php 

namespace App\Repositories\Admin;

use App\Repositories\Repository;
use App\Models\Admin;
use App\Repositories\Helpers\Filter;

class AdminRepository extends Repository implements AdminRepositoryInterface
{

    use Filter;

    protected function getModel(): String
    {
        return Admin::class;
    }

}

 ?>