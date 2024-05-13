<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;

use App\Repositories\User\UserRepository;

class Delete extends Component
{

    public $user;

    protected $listeners = ['delete' => 'open'];

    public function open(int $id)
    {
        $this->user = $id;

        $this->dispatchBrowserEvent('open-delete');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-delete');
    }

    public function delete(UserRepository $userRepo)
    {
        $userRepo->delete($this->user);

        $this->emit('reload', 'Data berhasil dihapus');
        $this->close();
    }
    
    public function render()
    {
        return view('livewire.admin.user.delete');
    }
}
