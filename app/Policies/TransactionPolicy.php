<?php

namespace App\Policies;

use App\Enums\Role;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{

    /**
     * @return Response
     */
    public function before(): Response
    {
        return auth()->user()->hasRole(Role::OPERATOR)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * @return bool
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function view(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function create(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        return true;
    }
}
