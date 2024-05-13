<?php

namespace App\Http\Livewire\Admin\Admin;

use Livewire\Component;

use App\Repositories\Admin\AdminRepository;

class Create extends Component
{

    public $name, $username, $password, $password_confirmation, $phone, $address, $role = 'admin';

    protected $rules = [
        'name' => 'required|string|unique:admins',
        'username' => 'required|string|unique:admins',
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|numeric|digits_between:10,15',
        'address' => 'required|string',
        'role' => 'required|in:admin,kasir,pelayanan,koki,bar'
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

    public function save(AdminRepository $adminRepo)
    {
        $data = $this->validate();

        $adminRepo->create($data);

        $this->emit('reload', 'Sukses menambahkan data');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.admin.create');
    }
}
