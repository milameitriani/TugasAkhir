<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};

use App\Repositories\User\UserRepository;

class UserController extends Controller
{

    public function search(UserRepository $userRepo, Request $request): JsonResponse
    {
        return response()->json($userRepo->search($request->name));
    }

}
