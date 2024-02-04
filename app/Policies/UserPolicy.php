<?php

namespace App\Policies;

use App\Enums\Role;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    /**
     * Determine whether the user can update or create the model.
     */
    public function createOrUpdate(): Response
    {
        return auth()->user()->hasRole(Role::OPERATOR)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): Response
    {
        return auth()->user()->hasRole(Role::ADMIN)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

}
