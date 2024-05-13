<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use App\Services\Auth\AuthService;

class Login extends Component
{

    public $redirect;
    public $name;
    public $remember = false;

    protected $rules = [
        'name' => 'required|string'
    ];

    public function mount()
    {
        if (session()->has('back')) {
            $this->redirect = session('back');
        }
    }

    public function login(AuthService $authService): Void
    {
        $credentials = $this->validate();

        if ($authService->loginByName($this->name, $this->remember)) {
            alert('Berhasil masuk');

            redirect()->route($this->redirect ?? 'home');
        } else {
            $this->addError('password', 'Kata sandi salah');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('_layouts.auth');
    }
}
