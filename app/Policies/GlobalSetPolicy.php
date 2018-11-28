<?php

namespace Statamic\Policies;

use Statamic\API\GlobalSet;

class GlobalSetPolicy
{
    public function index($user)
    {
        if ($this->create($user)) {
            return true;
        }

        return ! GlobalSet::all()->filter(function ($set) use ($user) {
            return $this->view($user, $set);
        })->isEmpty();
    }

    public function view($user, $set)
    {
        return $this->edit($user, $set);
    }

    public function edit($user, $set)
    {
        return $user->hasPermission("edit {$set->handle()} globals");
    }

    public function create($user)
    {
        //
    }

    public function delete($user, $set)
    {
        //
    }
}
