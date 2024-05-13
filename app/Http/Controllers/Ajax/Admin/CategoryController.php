<?php

namespace App\Http\Controllers\Ajax\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{

    public function search(CategoryRepository $categoryRepo, Request $request)
    {
        return response()->json($categoryRepo->get($request->name, $request->type));
    }

}
