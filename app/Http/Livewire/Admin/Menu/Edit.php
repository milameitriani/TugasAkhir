<?php

namespace App\Http\Livewire\Admin\Menu;

use Livewire\{Component, WithFileUploads};
use App\Traits\FileUpload;

use App\Repositories\Menu\MenuRepository;

class Edit extends Component
{

    use WithFileUploads, FileUpload;

    public $menu, $photo;

    protected $rules = [
        'menu.name' => '',
        'menu.price' => 'required|integer|min:1',
        'menu.description' => 'nullable|string',
        'menu.category_id' => 'nullable|exists:categories,id',
        'menu.type' => 'required|in:food,drink',
        'photo' => 'nullable|image'
    ];

    public function updatedMenuPrice($price)
    {
        $price = preg_replace('/\D/i', '', $price);

        $this->menu->price = (int)substr($price, 0, strlen($price) - 2);
    }

    public function updatedMenuType($value)
    {
        $this->category_id = null;

        $this->dispatchBrowserEvent('updated-type');
    }

    public function save()
    {
        $this->validate(array_merge($this->rules, [
            'menu.name' => 'required|string|unique:menus,name,'.$this->menu->id,
        ]));

        if ($this->photo) {
            $this->menu->photo = $this->upload($this->photo);
        }

        $this->menu->save();

        alert('Menu berhasil diperbarui');
        redirect()->route('admin.menus.index');
    }

    public function mount(MenuRepository $menuRepo, int $menu)
    {
        $this->menu = $menuRepo->find($menu);
    }

    public function render()
    {
        return view('livewire.admin.menu.edit')->extends('_layouts.admin.app');
    }
}
