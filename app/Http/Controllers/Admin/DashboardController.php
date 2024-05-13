<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

use App\Repositories\Order\Graphic\OrderGraphic as OrderGraphicRepo;
use App\Services\Order\Graphic\OrderGraphic as OrderGraphicService;
use App\Repositories\User\UserRepository;

class DashboardController extends Controller
{

    public function index(UserRepository $userRepo, Request $request): View
    {
        $request->validate(['type' => 'nullable|in:today,week,month,all']);

        $data = [
            'orderActive' => OrderGraphicRepo::countActive(),
            'orderPending' => OrderGraphicRepo::countPending(),
            'orderIncome' => OrderGraphicService::countIncome($request->type),
            'userCount' => $userRepo->count(),
            'orderFinishedGraphic' => OrderGraphicService::order(),
            'orderIncomeGraphic' => OrderGraphicService::income()
        ];

        return view('admin.dashboard', $data);
    }

}
