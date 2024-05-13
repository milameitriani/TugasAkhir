<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Table;
use App\Services\Auth\AuthService;

class LoginTable extends Component
{

    public $table;
    public $redirect;
    public $name;
    public $remember = false;

    protected $rules = [
        'name' => 'required|string'
    ];

    public function mount($table) {
        $this->table = Table::where('no', $table)->firstOrFail();

        if (session()->has('back')) {
            $this->redirect = session('back');
        }
    }

    public function login(AuthService $authService): Void
    {
        $credentials = $this->validate();

        if ($authService->loginByName($this->name, $this->remember, $this->table->id)) {
            alert('Berhasil masuk');

            redirect()->route($this->redirect ?? 'home');
        } else {
            $this->addError('password', 'Kata sandi salah');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-table')->extends('_layouts.auth');
    }
}
