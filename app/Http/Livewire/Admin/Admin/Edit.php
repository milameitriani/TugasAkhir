<?php

namespace App\Http\Livewire\Admin\Admin;

use Livewire\Component;

use App\Repositories\Admin\AdminRepository;

class Edit extends Component
{

    public $admin, $password, $password_confirmation;

    protected $rules = [
        'admin.name' => '',
        'admin.username' => '',
        'admin.phone' => 'required|numeric|digits_between:10,15',
        'admin.address' => 'required|string',
        'admin.role' => 'required|in:admin,kasir,pelayanan,koki,bar',
        'password' => 'nullable|string|min:6|confirmed',
    ];

    protected $listeners = ['edit' => 'open'];

    public function open(AdminRepository $adminRepo, int $id)
    {
        $this->reset();
        $this->resetValidation();

        $this->admin = $adminRepo->find($id);

        $this->dispatchBrowserEvent('open-edit');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-edit');
    }

    public function save()
    {
        $this->validate(array_merge($this->rules, [
            'admin.name' => 'required|string|unique:admins,name,'.$this->admin->id,
            'admin.username' => 'required|string|unique:admins,username,'.$this->admin->id,
        ]));

        if ($this->password) {
            $this->admin->password = $this->password;
        }

        $this->admin->save();

        $this->emit('reload', 'Sukses memperbarui data');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.admin.edit');
    }
}
