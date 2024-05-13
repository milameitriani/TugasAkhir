<?php

namespace App\Http\Livewire\Order;

use Illuminate\Http\Request;
use Livewire\Component;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Menu\MenuRepository;

class Filter extends Component
{

    public $take = 10;
    public $category = null;
    public $type = null;
    public $search;

    public function filterByCategory(int $id, $type)
    {
        $this->category = $id;
        $this->type = $type;

        $this->emit('filter-by-category', $id, $type);
    }

    public function filterByType($type)
    {
        $this->type = $type;
        $this->category = null;

        $this->emit('filter-by-type', $type);
    }

    public function resetFilterCategory()
    {
        $this->category = null;

        $this->emit('reset-filter-category');
    }

    public function resetFilterType()
    {
        $this->type = null;

        $this->emit('reset-filter-type');
    }

    public function updatedSearch(string $search)
    {
        $this->emit('search', $search);
    }

    public function updatedType($type)
    {
        $this->emit('search', $search);
    }

    public function mount(Request $request)
    {
        $this->category = $request->category;
        $this->type = $request->type;
        $this->search = $request->search;
    }

    public function render(CategoryRepository $categoryRepo, MenuRepository $menuRepo)
    {
        $categories = $categoryRepo->getTop($this->take, $this->type);
        $totalMenu = $menuRepo->count();
        $countFood = $menuRepo->countFood();
        $countDrink = $menuRepo->countDrink();

        return view('livewire.order.filter', compact('categories', 'totalMenu', 'countFood', 'countDrink'));
    }
}
