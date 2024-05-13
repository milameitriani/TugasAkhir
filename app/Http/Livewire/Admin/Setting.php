<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Contracts\Cache\Factory;

use App\Models\Setting as SettingModel;

class Setting extends Component
{

    public $setting;

    protected $rules = [
        'setting.name' => 'required|string|min:3',
        'setting.address' => 'required|string|min:5',
        'setting.phone' => 'required|numeric|'
    ];

    public function save(Factory $cache)
    {
        $this->validate();

        $this->setting->save();
        
        $cache->forget('setting');

        alert('Pengaturan berhasil disimpan');
    }

    public function mount(SettingModel $setting)
    {
        $this->setting = $setting->first();
    }

    public function render()
    {
        return view('livewire.admin.setting')->extends('_layouts.admin.setting');
    }
}
