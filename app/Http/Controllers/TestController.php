<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ibrahimalanshor\SimpleAuth\Services\AuthService;

class TestController extends Controller
{

    // public function test(AuthService $auth)
    // {
    //     $user = [
    //         'username' => 'admin',
    //         'password' => 'admin'
    //     ];
    //     $remember = false;

    //     $auth->logout();
    // }

    public function test()
    {
        return Helper::alert('oke');
    }

}
