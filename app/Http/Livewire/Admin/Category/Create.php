<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;

use App\Repositories\Category\CategoryRepository;

class Create extends Component
{

    public $name, $type = 'food';

    protected $listeners = [
        'create' => 'open'
    ];

    protected $rules = [
        'name' => 'required|string|unique:categories',
        'type' => 'required|in:food,drink'
    ];

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

    public function save(CategoryRepository $categoryRepo)
    {
        $data = $this->validate();

        $categoryRepo->create($data);

        $this->emitUp('reload', 'Kategori berhasil ditambahkan');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.category.create');
    }
}
