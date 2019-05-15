<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConcertPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        Gate::define("read-concert", function($user) {
            return $user->hasAccess(["read-concert"]);
        });
    }

    public function create(User $user)
    {
        Gate::define("create-concert", function($user) {
            return $user->hasAccess(["create-concert"]);
        });
    }

    public function update(User $user)
    {
        Gate::define("update-concert", function($user) {
            return $user->hasAccess(["update-concert"]);
        });
    }

    public function delete(User $user)
    {
        Gate::define("delete-concert", function($user) {
            return $user->hasAccess(["delete-concert"]);
        });
    }

}
