<?php 

namespace App\Traits\Livewire;

use Illuminate\Support\Facades\Cookie;

trait OrderCart
{

    public $menus = [];

    function setMenus(array $menus) {
        $this->menus = collect($menus)->map(function ($item)
        {
            return [
                'menu' => (array) $item->menu,
                'qty' => $item->qty
            ];
        })->all();
    }

    public function store(array $menu)
    {
        $id = $menu['id'];

        if ($this->exists($id)) {
            $this->update($id);
        } else {
            array_push($this->menus, [
                'menu' => $menu,
                'qty' => 1
            ]);
        }

        $this->persist();
    }

    public function update(int $id)
    {
        $index = $this->search($id);

        $this->menus[$index]['qty']++;
    }

    public function increment(int $id)
    {
        $index = $this->search($id);

        $this->menus[$index]['qty']++;

        $this->persist();
        $this->dispatchUpdatedQtyEvent();
    }

    public function decrement(int $id)
    {
        $index = $this->search($id);

        if ($this->menus[$index]['qty'] === 1) {
            $this->remove($id);
        } else {
            $this->menus[$index]['qty']--;
        }

        $this->persist();
        $this->dispatchUpdatedQtyEvent();
    }

    public function remove(int $id)
    {
        $this->menus = collect($this->menus)->reject(function ($item) use ($id)
        {
            return $item['menu']['id'] === $id;
        })->values()->all();

        $this->persist();
    }

    public function search(int $id): Int
    {
        return collect($this->menus)->search(function ($item) use ($id)
        {
            return $item['menu']['id'] === $id;
        });
    }

    public function exists(int $id): Bool
    {
        return collect($this->menus)->contains(function ($item) use ($id)
        {
            return $item['menu']['id'] === $id;
        });
    }

    public function process()
    {
        $this->redirectProcess();
    }

    public function persist() {
        Cookie::queue(Cookie::forget('carts-'.$this->key));
        Cookie::queue(Cookie::make('carts-'.$this->key, json_encode($this->menus), 120));
    }

    public function dispatchUpdatedQtyEvent() {
        $this->dispatchBrowserEvent('updated-qty');
    }

}

 ?>