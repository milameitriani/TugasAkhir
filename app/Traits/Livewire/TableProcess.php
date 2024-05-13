<?php 

namespace App\Traits\Livewire;

use Illuminate\Support\Facades\Cookie;

trait TableProcess
{

    public function remove(int $id)
    {
        $menus = collect($this->menus)->filter(function ($item) use ($id)
        {
            return $item['menu']['id'] !== $id;
        })->values()->all();

        if (!$menus) {
            $this->resetCarts();

            $this->redirectBack();
        }

        $this->store($menus);
    }

    public function store(array $menus)
    {
        Cookie::queue(Cookie::forget('carts-'.$this->key));
        Cookie::queue(Cookie::make('carts-'.$this->key, json_encode($menus), 120));

        $this->menus = $menus;

        $this->countTotal();
    }

    public function resetCarts()
    {
        Cookie::queue(Cookie::forget('carts-'.$this->key));
    }

}

 ?>