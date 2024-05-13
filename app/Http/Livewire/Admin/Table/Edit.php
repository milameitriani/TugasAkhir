<?php

namespace App\Http\Livewire\Admin\Table;

use Livewire\Component;

use App\Repositories\Table\TableRepository;

class Edit extends Component
{

    public $table;

    protected $rules = ['table.no' => ''];

    protected $listeners = ['edit' => 'open'];

    public function open(TableRepository $tableRepo, int $id)
    {
        $this->table = $tableRepo->find($id);

        $this->resetValidation();

        $this->dispatchBrowserEvent('open-edit');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-edit');
    }

    public function save()
    {
        $this->validate(['table.no' => 'required|unique:tables,no,'.$this->table->id]);

        $this->table->save();

        $this->emit('reload', 'Meja berhasil diperbarui');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.table.edit');
    }
}
