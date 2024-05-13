<?php

namespace App\Http\Livewire\Admin\Table;

use Livewire\Component;

use App\Repositories\Table\TableRepository;

class Create extends Component
{

    public $no;

    protected $rules = ['no' => 'required|unique:tables'];

    protected $listeners = ['create' => 'open'];

    public function open()
    {
        $this->reset();
        $this->resetValidation();

        $this->dispatchBrowserEvent('open-create');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-create');
    }

    public function save(TableRepository $tableRepo)
    {
        $data = $this->validate();

        $tableRepo->create($data);

        $this->emit('reload', 'Meja berhasil ditambahkan');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.table.create');
    }
}
