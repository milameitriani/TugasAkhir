<?php

namespace App\Http\Livewire\Admin\Table;

use Livewire\Component;

use App\Traits\Livewire\TableFilter;
use App\Repositories\Table\TableRepository;

class Table extends Component
{

    use TableFilter;

    protected $listeners = ['reload'];

    public function render(TableRepository $tableRepo)
    {
        $tables = $tableRepo->filter($this->search, $this->take);

        return view('livewire.admin.table.table', compact('tables'))->extends('_layouts.admin.app');
    }
}
