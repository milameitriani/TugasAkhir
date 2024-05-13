<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;

use App\Repositories\User\UserRepository;

class Edit extends Component
{

    public $user, $password, $password_confirmation;

    protected $rules = [
        'user.name' => '',
    ];

    protected $listeners = ['edit' => 'open'];

    public function open(UserRepository $userRepo, int $id)
    {
        $this->reset();
        $this->resetValidation();

        $this->user = $userRepo->find($id);

        $this->dispatchBrowserEvent('open-edit');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-edit');
    }

    public function save()
    {
        $this->validate(array_merge($this->rules, [
            'user.name' => 'required|string|unique:users,name,'.$this->user->id,
        ]));

        if ($this->password) {
            $this->user->password = $this->password;
        }

        $this->user->save();

        $this->emit('reload', 'Sukses memperbarui data');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.user.edit');
    }
}
