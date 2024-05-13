<?php 

namespace App\Repositories\User;

interface UserRepositoryInterface
{

    public function updateEmailVerifiedAt(int $id, string $date = null): Void;

    public function countInactive(): Int;

}

 ?>