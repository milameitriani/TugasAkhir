<?php

namespace App\Http\Controllers\Ajax\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Notification\NotificationService;

class NotificationController extends Controller
{
    
    /**
     * notificationService
     *
     * @var mixed
     */
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService) {
        $this->notificationService = $notificationService;
    }
        
    /**
     * getNotifications
     *
     * @return void
     */
    public function getNotifications() {
        return $this->notificationService->getNotifications(auth()->user());
    }

}
