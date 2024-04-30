<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;

class StatusPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $currentUser, Status $status)
    {
        return $status->user_id === $currentUser->id;
    }
}
