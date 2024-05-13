<?php 

namespace App\Services\Auth;

use App\Services\AuthServiceInterface as AuthService;

interface AuthServiceInterface extends AuthService
{

    public function register(array $data): Void;

    public function login(array $credentials, bool $remember): Bool;

    public function logout(): Void;

}

 ?>