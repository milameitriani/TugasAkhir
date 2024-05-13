<?php

namespace App\Http\Livewire\Admin\Table;

use Livewire\Component;

use App\Repositories\Table\TableRepository;

class Delete extends Component
{

    public $tableId;

    protected $listeners = ['delete' => 'open'];

    public function open(int $id)
    {
        $this->tableId = $id;

        $this->dispatchBrowserEvent('open-delete');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-delete');
    }

    public function delete(TableRepository $tableRepo)
    {
        $tableRepo->delete($this->tableId);

        $this->emit('reload', 'Meja berhasil dihapus');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.table.delete');
    }
}
