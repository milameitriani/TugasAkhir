<?php

namespace App\Http\Livewire\Admin\Menu;

use Livewire\Component;

use App\Repositories\Menu\MenuRepository;
use App\Traits\Livewire\TableFilter;

class Table extends Component
{

    use TableFilter;

    public $type;

    protected $listeners = ['reload'];

    public function render(MenuRepository $menuRepo)
    {
        $menus = $menuRepo->filter($this->search, $this->type, null, $this->take);

        return view('livewire.admin.menu.table', compact('menus'))->extends('_layouts.admin.app');
    }
}
