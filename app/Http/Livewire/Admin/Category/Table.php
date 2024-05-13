<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;

use App\Repositories\Category\CategoryRepository;
use App\Traits\Livewire\TableFilter;

class Table extends Component
{

    use TableFilter;

    public $type;

    protected $listeners = ['reload'];

    public function render(CategoryRepository $categoryRepo)
    {
        $categories = $categoryRepo->filter($this->search, $this->take, $this->type);

        return view('livewire.admin.category.table', compact('categories'))->extends('_layouts.admin.app');
    }
}
