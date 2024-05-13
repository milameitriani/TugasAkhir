<?php

namespace App\Http\Livewire\Order;

use Livewire\{Component, WithPagination};

use App\Repositories\Menu\MenuRepository;

class Search extends Component
{

    use WithPagination;

    public $search, $category, $type;

    protected $queryString = ['search', 'category', 'type'];
    protected $listeners = [
        'filter-by-category' => 'filterByCategory',
        'reset-filter-category' => 'resetFilterCategory',
        'reset-filter-type' => 'resetFilterType',
        'search',
        'filter-by-type' => 'filterByType'
    ];

    public function filterByCategory(int $category, $type)
    {
        $this->resetPage();

        $this->category = $category;
        $this->type = $type;
    }

    public function filterByType($type)
    {
        $this->resetPage();

        $this->type = $type;
        $this->category = null;
    }

    public function search(string $search)
    {
        $this->search = $search;
        
        $this->resetPage();
    }

    public function resetFilterCategory()
    {
        $this->category = null;
    }

    public function resetFilterType()
    {
        $this->type = null;
    }

    public function store(array $menu)
    {
        $this->emit('store', $menu);
    }

    public function paginationView()
    {
        return '_partials.pagination';
    }

    public function render(MenuRepository $menuRepo)
    {
        $menus = $menuRepo->filter($this->search, $this->type, $this->category);

        return view('livewire.order.search', compact('menus'));
    }
}
