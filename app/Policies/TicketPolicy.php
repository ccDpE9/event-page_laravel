<?php

namespace App\Policies;

use App\User;
use App\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        Gate::define("read-ticket", function($user) {
            return $user->hasAccess(["read-ticket"]);
        });
    }

    public function create(User $user)
    {
        Gate::define("create-ticket", function($user) {
            return $user->hasAccess(["create-ticket"]);
        });
    }

    public function update(User $user)
    {
        Gate::define("update-ticket", function($user) {
            return $user->hasAccess(["update-ticket"]);
        });
    }

    public function delete(User $user)
    {
        Gate::define("delete-ticket", function($user) {
            return $user->hasAccess(["delete-ticket"]);
        });
    }
}
