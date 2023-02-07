<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PolicyUser
{
    use HandlesAuthorization;
    public function any(User $user)
    {
        return $user->role == 'admin'
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
