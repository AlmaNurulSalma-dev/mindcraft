<?php

namespace App\Policies;

use App\Models\Mentorship;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MentorshipPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isMentor();
    }

    public function view(User $user, Mentorship $mentorship): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa lihat mentorship sendiri
        if ($user->isMentor()) {
            return $mentorship->mentor_id === $user->id;
        }

        // Mentee bisa lihat mentorship sendiri
        if ($user->isMentee()) {
            return $mentorship->user_id === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Mentorship $mentorship): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa update status mentorship sendiri
        if ($user->isMentor()) {
            return $mentorship->mentor_id === $user->id;
        }

        return false;
    }

    public function delete(User $user, Mentorship $mentorship): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Mentorship $mentorship): bool
    {
        return false;
    }

    public function forceDelete(User $user, Mentorship $mentorship): bool
    {
        return false;
    }
}
