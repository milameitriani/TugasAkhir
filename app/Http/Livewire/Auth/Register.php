<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use App\Services\Auth\AuthService;

class Register extends Component
{

    public $name, $username, $password, $password_confirmation;

    protected $rules = [
        'name' => 'required|string|unique:users',
        'username' => 'required|string|unique:users',
        'password' => 'required|string|min:5|confirmed',
    ];

    public function register(AuthService $authService)
    {
        $data = $this->validate();

        $authService->register($data);

        alert('Registrasi berhasil');
        redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('_layouts.auth');
    }
}
