<?php 

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

use App\Repositories\User\UserRepository;
use App\Models\User;

class AuthService implements AuthServiceInterface
{

    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data): Void
    {
        $user = $this->userRepo->create($data);

        Auth::login($user);
    }

    public function login(array $credentials, bool $remember): Bool
    {
        return Auth::attempt($credentials, $remember);
    }

    public function logout(): Void
    {
        Auth::logout();
    }

    public function loginByName(string $name, bool $remember, int $tableId = null): bool {
        $user = User::updateOrCreate(['name' => $name], ['table_id' => $tableId]);

        Auth::login($user, $remember);

        return true;
    }

}

 ?>