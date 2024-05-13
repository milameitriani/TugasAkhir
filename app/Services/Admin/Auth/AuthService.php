<?php 

namespace App\Services\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Services\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{

    private function guard(): Guard
    {
        return Auth::guard('admin');
    }

    public function login(array $credentials, bool $remember): Bool
    {
        return $this->guard()->attempt($credentials, $remember);
    }

    public function logout(): Void
    {
        $this->guard()->logout();
    }

}

 ?>