<?php

namespace App\Policies;

use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TutorialPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Tutorial $tutorial)
    {
        return $tutorial->user_id === $user->id;
    }

    public function delete(User $user, Tutorial $tutorial)
    {
        return $tutorial->user_id === $user->id;
    }

}
