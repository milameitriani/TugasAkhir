<?php

namespace App\Policies;

use App\Models\{Order, Admin, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the User can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    /**
     * Determine whether the User can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    /**
     * Determine whether the User can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    /**
     * Determine whether the Admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAdmin(Admin $admin, Order $order)
    {
        if ($admin->role === 'admin' || $admin->role === 'kasir' || $admin->role === 'koki' || $admin->role === 'bar') {
            return true;
        }

        if ($order->status === 'pending') {
            return true;
        }
        
        return $admin->id === $order->admin_id;
    }

    /**
     * Determine whether the Admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateAdmin(Admin $admin, Order $order)
    {
        return $admin->id === $order->admin_id || $admin->role === 'admin';
    }

    /**
     * Determine whether the Admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAdmin(Admin $admin, Order $order)
    {
        return $admin->id === $order->admin_id || $admin->role === 'admin';
    }
}
