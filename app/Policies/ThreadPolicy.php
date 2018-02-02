<?php

namespace App\Policies;

use App\User;
use App\Thread;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Thread $thread)
    {

        $rules = ($user->id === $thread->user_id) || ($user->role === 'admin');
        return $rules;

    }

    public function isAdmin(User $user){
        return $user->role === 'admin';
    }
}
