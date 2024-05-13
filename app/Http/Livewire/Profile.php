<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{

    public $user, $password, $password_confirmation;

    protected $rules = [
        'user.name' => '',
        'user.username' => '',
        'password' => 'nullable|string|min:5|confirmed',
    ];

    public function save()
    {
        $this->validate(array_merge($this->rules, [
            'user.name' => 'required|string|unique:users,name,'.$this->user->id,
            'user.username' => 'required|string|unique:users,username,'.$this->user->id
        ]));

        if ($this->password) {
            $this->user->password = $this->password;
        }

        $this->user->save();

        alert('Profil berhasil disimpan');
    }

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.profile')->extends('_layouts.setting');
    }
}
