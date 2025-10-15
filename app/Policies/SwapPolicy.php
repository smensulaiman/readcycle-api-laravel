<?php

namespace App\Policies;

use App\Models\Swap;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SwapPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Any authenticated user can view swaps
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Swap $swap): bool
    {
        // User can view if they are the requester, or owner of either book
        return $user->id === $swap->requester_id ||
               $user->id === $swap->bookRequested->user_id ||
               $user->id === $swap->bookOffered->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Any authenticated user can create swap requests
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Swap $swap): bool
    {
        // Only the requester or the owner of the requested book can update
        return $user->id === $swap->requester_id ||
               $user->id === $swap->bookRequested->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Swap $swap): bool
    {
        // Only the requester or the owner of the requested book can delete
        return $user->id === $swap->requester_id ||
               $user->id === $swap->bookRequested->user_id;
    }

    /**
     * Determine whether the user can update the swap status.
     */
    public function updateStatus(User $user, Swap $swap): bool
    {
        // Only the owner of the requested book can accept/decline
        return $user->id === $swap->bookRequested->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Swap $swap): bool
    {
        return $user->id === $swap->requester_id ||
               $user->id === $swap->bookRequested->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Swap $swap): bool
    {
        return $user->id === $swap->requester_id ||
               $user->id === $swap->bookRequested->user_id;
    }
}
