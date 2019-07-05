<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConcertPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    public function delete(User $user)
    {
        if ($user->is_admin) {
            return true;
        }
    }

}
