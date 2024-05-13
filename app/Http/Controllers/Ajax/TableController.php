<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};

use App\Repositories\Table\TableRepository;

class TableController extends Controller
{

    public function search(TableRepository $tableRepo, Request $request): JsonResponse
    {
        if ($request->has('hasorder')) {
            $tables = $tableRepo->searchHasOrder($request->no);
        } else if ($request->has('all')) {
            $tables = $tableRepo->searchAll($request->no);
        } else {
            $tables = $tableRepo->searchInactive($request->no);
        }

        return response()->json($tables);
    }

}
