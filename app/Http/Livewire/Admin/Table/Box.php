<?php

namespace App\Http\Livewire\Admin\Table;

use Livewire\Component;
use App\Repositories\Table\TableRepository;

class Box extends Component
{

    public $status;

    protected $listeners = ['reload'];

    public function reload()
    {
        // code...
    }

    public function render(TableRepository $tableRepo)
    {
        $tables = $tableRepo->get();

        return view('livewire.admin.table.box', compact('tables'));
    }
}
