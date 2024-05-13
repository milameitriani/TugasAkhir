<?php 

namespace App\Repositories\User;

use App\Repositories\Repository;
use App\Models\User;
use App\Repositories\Helpers\{Filter, Search};

class UserRepository extends Repository implements UserRepositoryInterface
{

    use Filter, Search;

    protected function getModel(): String
    {
        return User::class;
    }

    public function search(string $search = null): Object
    {
        return $this->model->where('name', 'like', '%'.$search.'%')->whereNotNull('email_verified_at')->get();
    }

    public function filter(string $search = null, int $take = null, bool $status = null): Object
    {
        return $this->model->when(!is_null($status), function ($user) use ($status)
        {
            return $status ? $user->whereNotNull('email_verified_at') : $user->whereNull('email_verified_at');
        })->where($this->filterKey ?? 'name', 'like', '%'.$search.'%')->paginate($take);
    }

    public function updateEmailVerifiedAt(int $id, string $date = null): Void
    {
        $user = $this->find($id);

        $user->email_verified_at = $date;
        $user->save();
    }

    public function countInactive(): Int
    {
        return $this->model->whereNull('email_verified_at')->count();
    }

}

 ?>