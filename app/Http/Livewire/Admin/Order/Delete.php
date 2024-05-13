<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;

use App\Repositories\Order\OrderRepository;

class Delete extends Component
{

    public $order;

    protected $listeners = ['delete' => 'open'];

    public function delete(OrderRepository $orderRepo)
    {
        $orderRepo->delete($this->order);

        $this->emit('reload', 'Berhasil menghapus order');
        $this->close();
    }

    public function open(int $id)
    {
        $this->order = $id;

        $this->dispatchBrowserEvent('open-delete');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-delete');
    }

    public function render()
    {
        return view('livewire.admin.order.delete');
    }
}
