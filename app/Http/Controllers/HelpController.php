<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

use App\Models\Help;

class HelpController extends Controller
{

    public function index(): View
    {
        $help = Help::first();

        return view('help', compact('help'));
    }

}
