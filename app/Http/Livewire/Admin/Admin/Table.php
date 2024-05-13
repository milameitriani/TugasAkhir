<?php

namespace App\Http\Livewire\Admin\Admin;

use Livewire\Component;

use App\Traits\Livewire\TableFilter;
use App\Repositories\Admin\AdminRepository;

class Table extends Component
{

    use TableFilter;

    protected $listeners = ['reload'];

    public function render(AdminRepository $adminRepo)
    {
        $admins = $adminRepo->filter($this->search, $this->take);

        return view('livewire.admin.admin.table', compact('admins'))->extends('_layouts.admin.app');
    }
}
