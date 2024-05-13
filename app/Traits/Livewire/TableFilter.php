<?php 

namespace App\Traits\Livewire;

use Livewire\WithPagination;

trait TableFilter
{

    use WithPagination;

    public $search, $take = 10;

    public function updatedTake()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->search = '';

        $this->resetPage();
    }

    public function reload(string $msg)
    {
        $this->resetFilter();

        session()->flash('success', $msg);
    }

    public function paginationView()
    {
        return '_partials.pagination';
    }

} 

 ?>