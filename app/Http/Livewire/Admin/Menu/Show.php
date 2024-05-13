<?php

namespace App\Http\Livewire\Admin\Menu;

use Livewire\Component;

use App\Repositories\Menu\MenuRepository;

class Show extends Component
{

    public $menu;

    protected $listeners = ['show' => 'open'];

    public function open(MenuRepository $menuRepo, int $id)
    {
        $this->menu = $menuRepo->find($id);

        $this->dispatchBrowserEvent('open-show');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-show');
    }

    public function render()
    {
        return view('livewire.admin.menu.show');
    }
}
