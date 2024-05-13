<?php

namespace App\Services\Notification;

use App\Models\Admin;
use App\Repositories\Order\Graphic\OrderGraphic;
use App\Repositories\User\UserRepository;

/**
 * NotificationService
 */
class NotificationService {
    
    /**
     * orderRepo
     *
     * @var mixed
     */
    protected OrderGraphic $orderRepo;
    
    /**
     * __construct
     *
     * @param  mixed $orderRepo
     * @return void
     */
    public function __construct(OrderGraphic $orderRepo) {
        $this->orderRepo = $orderRepo;
    }
    
    /**
     * getNotifications
     *
     * @return void
     */
    public function getNotifications(Admin $user) {
        $isAdmin = $user->role === 'admin';

        $pendingOrder = $this->orderRepo->countPending($isAdmin ? $user : null);
        $pendingDrink = $this->orderRepo->countDrink($isAdmin ? $user : null, 'active', false);
        $pendingCooking = $this->orderRepo->countCooking($isAdmin ? $user : null, 'active', false);
        $finishDrink = $this->orderRepo->countDrink($isAdmin ? $user : null, 'active', true);
        $finishCooking = $this->orderRepo->countCooking($isAdmin ? $user : null, 'active', true);
        $count;

        switch ($user->role) {
            case 'admin':
                $count = $pendingOrder;
                break;
            case 'pelayanan':
                $count = $pendingOrder + $finishDrink + $finishCooking;
                break;
            case 'bar':
                $count = $pendingDrink;
                break;
            case 'koki':
                $count = $pendingCooking;
                break;
        }

        return [
            'pendingOrder' => $pendingOrder,
            'pendingDrink' => $pendingDrink,
            'pendingCooking' => $pendingCooking,
            'finishDrink' => $finishDrink,
            'finishCooking' => $finishCooking,
            'count' => $count,
            'role' => $user->role
        ];
    }
}