<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;

use App\Repositories\Category\CategoryRepository;

class Delete extends Component
{

    public $category;

    protected $listeners = [
        'delete' => 'open'
    ];

    public function open(int $id)
    {
        $this->category = $id;

        $this->dispatchBrowserEvent('open-delete');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-delete');
    }

    public function delete(CategoryRepository $categoryRepo)
    {
        $categoryRepo->delete($this->category);

        $this->emitUp('reload', 'Kategori berhasil dihapus');
        $this->close();
    }

    public function render()
    {
        return view('livewire.admin.category.delete');
    }
}
