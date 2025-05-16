<?php

namespace App\Policies;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RegistrationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Registration $registration): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa lihat registration dari course yang di-assign
        if ($user->isMentor()) {
            return $registration->course->mentorships()
                ->where('mentor_id', $user->id)
                ->exists();
        }

        // Mentee bisa lihat registration sendiri
        if ($user->isMentee()) {
            return $registration->user_id === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isMentee();
    }

    public function update(User $user, Registration $registration): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa update progress student di course mereka
        if ($user->isMentor()) {
            return $registration->course->mentorships()
                ->where('mentor_id', $user->id)
                ->exists();
        }

        return false;
    }

    public function delete(User $user, Registration $registration): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Registration $registration): bool
    {
        return false;
    }

    public function forceDelete(User $user, Registration $registration): bool
    {
        return false;
    }
}
