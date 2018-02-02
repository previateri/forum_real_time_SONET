<?php

namespace App\Policies;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Reply $reply)
    {
        return $user->role === 'admin';
    }

    public function sendReply(User $user, Reply $reply){


        $rule = ($reply->thread->closed ? false : true);

        return $rule;
    }
}
