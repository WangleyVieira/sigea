<?php

namespace App\Policies;

use App\Perfil;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can list users.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function listarUserExterno(User $user)
    {
        if ($user->isUserExterno()) {
            return true;
        }
    }
}
