<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;

use App\Repositories\Menu\MenuRepository;

class Show extends Component
{

    public $menu;

    protected $listeners = ['show' => 'open'];

    public function open(MenuRepository $menuRepo, int $id)
    {
        $this->menu = $menuRepo->find($id);

        $this->dispatchBrowserEvent('open');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close');
    }

    public function addToCart() {
        $this->emit('store', $this->menu);
    }

    public function render()
    {
        return view('livewire.order.show');
    }
}
