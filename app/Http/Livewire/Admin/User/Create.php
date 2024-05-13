<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;

use App\Repositories\User\UserRepository;

class Create extends Component
{

    public $name, $username, $password, $password_confirmation;

    protected $rules = [
        'name' => 'required|string|unique:users',
    ];

    protected $listeners = ['create' => 'open'];

    public function open()
    {
        $this->reset();
        $this->resetValidation();

        $this->dispatchBrowserEvent('open-create');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-create');
    }

    public function save(UserRepository $userRepo)
    {
        $data = $this->validate();

        $userRepo->create($data);

        $this->emit('reload', 'Sukses menambahkan data');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.user.create');
    }
}
