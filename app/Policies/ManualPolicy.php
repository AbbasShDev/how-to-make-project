<?php

namespace App\Policies;

use App\Models\Manual;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManualPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Manual $manual)
    {
        return $manual->user_id === $user->id;
    }

    public function delete(User $user, Manual $manual)
    {
        return $manual->user_id === $user->id;
    }

}
