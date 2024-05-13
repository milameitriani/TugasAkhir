<?php

namespace App\Http\Livewire\Admin\Menu;

use Livewire\{Component, WithFileUploads};
use App\Traits\FileUpload;

use App\Repositories\Menu\MenuRepository;

class Create extends Component
{

    use WithFileUploads, FileUpload;

    public $name, $price, $description, $photo, $category_id, $type = 'food';

    protected $rules = [
        'name' => 'required|string|unique:menus',
        'price' => 'required|integer|min:1',
        'photo' => 'required|image',
        'category_id' => 'nullable|exists:categories,id',
        'type' => 'required|in:food,drink'
    ];

    public function updatedPrice($price)
    {
        $price = preg_replace('/\D/i', '', $price);

        $this->price = (int)substr($price, 0, strlen($price) - 2);
    }

    public function updatedType($value)
    {
        $this->category_id = null;

        $this->dispatchBrowserEvent('updated-type');
    }

    public function save(MenuRepository $menuRepo)
    {
        $data = $this->validate();

        $data['photo'] = $this->upload($this->photo);

        $menuRepo->create($data);

        alert('Menu berhasil dibuat');
        redirect()->route('admin.menus.index');
    }

    public function render()
    {
        return view('livewire.admin.menu.create')->extends('_layouts.admin.app');
    }
}
