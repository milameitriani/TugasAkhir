<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;

use App\Repositories\Category\CategoryRepository;

class Edit extends Component
{

    public $category;

    protected $listeners = [
        'edit' => 'open'
    ];

    protected $rules = [
        'category.name' => '',
        'category.type' => 'required|in:food,drink'
    ];

    public function open(CategoryRepository $categoryRepo, int $id)
    {
        $this->resetValidation();
     
        $this->category = $categoryRepo->find($id);   

        $this->dispatchBrowserEvent('open-edit');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-edit');
    }

    public function save()
    {
        $this->validate(array_merge($this->rules, [
            'category.name' => 'required|string|unique:categories,name,'.$this->category->id
        ]));

        $this->category->save();

        $this->emitUp('reload', 'Kategori berhasil diperbarui');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.category.edit');
    }
}
