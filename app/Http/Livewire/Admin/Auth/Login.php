<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;

use App\Services\Admin\Auth\AuthService;

class Login extends Component
{

    public $username, $password;
    public $remember = false;

    protected $rules = [
        'username' => 'required|string|exists:admins',
        'password' => 'required|string'
    ];

    public function login(AuthService $authService): Void
    {
        $credentials = $this->validate();

        if ($authService->login($credentials, $this->remember)) {
            alert('Berhasil masuk');

            redirect()->route('admin.home');
        } else {
            $this->addError('password', 'Kata sandi salah');
        }
    }

    public function render()
    {
        return view('livewire.admin.auth.login')->extends('_layouts.auth');
    }
}
