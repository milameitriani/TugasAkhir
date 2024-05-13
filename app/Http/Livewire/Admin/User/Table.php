<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;

use App\Traits\Livewire\TableFilter;
use App\Repositories\User\UserRepository;

class Table extends Component
{

    use TableFilter;

    public $status;

    protected $queryString = ['status'];

    protected $listeners = ['reload'];

    public function confirm(UserRepository $userRepo, int $id)
    {
        $userRepo->updateEmailVerifiedAt($id, now());

        $this->reload('Data berhasil dikonfirmasi');
    }

    public function unconfirm(UserRepository $userRepo, int $id)
    {
        $userRepo->updateEmailVerifiedAt($id, null);

        $this->reload('Konfirmasi berhasil dibatalkan');
    }

    public function resetFilter()
    {
        $this->search = null;
        $this->status = null;

        $this->resetPage();
        $this->dispatchBrowserEvent('reset');
    }

    public function render(UserRepository $userRepo)
    {
        $users = $userRepo->filter($this->search, $this->take, $this->status ? $this->status === 'active' : null);

        return view('livewire.admin.user.table', compact('users'))->extends('_layouts.admin.app');
    }
}
