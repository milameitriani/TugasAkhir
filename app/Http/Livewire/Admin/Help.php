<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Help as HelpModel;

class Help extends Component
{

    public $help;

    protected $rules = [
        'help.content' => 'required|string'
    ];

    public function save()
    {
        $this->validate();

        $this->help->save();

        alert('Petunjuk berhasil diperbarui');
    }

    public function mount(HelpModel $help)
    {
        $this->help = $help->first();
    }

    public function render()
    {
        return view('livewire.admin.help')->extends('_layouts.admin.setting');
    }
}
