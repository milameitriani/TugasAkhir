<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

use App\Services\Admin\Auth\AuthService;

class AuthController extends Controller
{

    public function logout(AuthService $authService): RedirectResponse
    {
        $authService->logout();

        return redirect()->route('admin.login');
    }

}
