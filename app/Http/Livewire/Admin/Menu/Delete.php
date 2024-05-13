<?php

namespace App\Http\Livewire\Admin\Menu;

use Livewire\Component;

use App\Repositories\Menu\MenuRepository;

class Delete extends Component
{

    public $menu;

    protected $listeners = ['delete' => 'open'];

    public function delete(MenuRepository $menuRepo)
    {
        $menuRepo->delete($this->menu);

        $this->emit('reload', 'Berhasil menghapus menu');
        $this->close();
    }

    public function open(int $id)
    {
        $this->menu = $id;

        $this->dispatchBrowserEvent('open-delete');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-delete');
    }

    public function render()
    {
        return view('livewire.admin.menu.delete');
    }
}
