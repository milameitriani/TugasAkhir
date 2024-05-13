<?php

namespace App\Http\Livewire\Admin\Admin;

use Livewire\Component;

use App\Repositories\Admin\AdminRepository;

class Delete extends Component
{

    public $admin;

    protected $listeners = ['delete' => 'open'];

    public function open(int $id)
    {
        $this->admin = $id;

        $this->dispatchBrowserEvent('open-delete');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-delete');
    }

    public function delete(AdminRepository $adminRepo)
    {
        $adminRepo->delete($this->admin);

        $this->emit('reload', 'Data berhasil dihapus');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.admin.delete');
    }
}
