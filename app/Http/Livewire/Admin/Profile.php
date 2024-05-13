<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Profile extends Component
{

    public $user, $password, $password_confirmation;

    protected $rules = [
        'user.name' => '',
        'user.username' => '',
        'user.address' => 'required|string',
        'user.phone' => 'required|numeric|digits_between:10,15',
        'password' => 'nullable|string|min:5|confirmed',
    ];

    public function save()
    {
        $this->validate(array_merge($this->rules, [
            'user.name' => 'required|string|unique:admins,name,'.$this->user->id,
            'user.username' => 'required|string|unique:admins,username,'.$this->user->id
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
        return view('livewire.admin.profile')->extends('_layouts.admin.setting');
    }
}
