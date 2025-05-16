<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserQuestion;
use Illuminate\Auth\Access\Response;

class UserQuestionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, UserQuestion $userQuestion): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa lihat question dari course yang di-assign
        if ($user->isMentor()) {
            return $userQuestion->course->mentorships()
                ->where('mentor_id', $user->id)
                ->exists();
        }

        // Mentee bisa lihat question sendiri
        if ($user->isMentee()) {
            return $userQuestion->user_id === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isMentee();
    }

    public function update(User $user, UserQuestion $userQuestion): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa update (answer) question
        if ($user->isMentor()) {
            return $userQuestion->course->mentorships()
                ->where('mentor_id', $user->id)
                ->exists();
        }

        return false;
    }

    public function delete(User $user, UserQuestion $userQuestion): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, UserQuestion $userQuestion): bool
    {
        return false;
    }

    public function forceDelete(User $user, UserQuestion $userQuestion): bool
    {
        return false;
    }
}
