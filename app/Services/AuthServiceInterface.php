<?php 

namespace App\Services;

interface AuthServiceInterface
{

    public function login(array $credentials, bool $remember): Bool;

    public function logout(): Void;

}

 ?>