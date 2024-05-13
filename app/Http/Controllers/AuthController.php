<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

use App\Services\Auth\AuthService;

class AuthController extends Controller
{

    public function logout(AuthService $authService): RedirectResponse
    {
        $authService->logout();

        return redirect()->route('home');
    }

}
