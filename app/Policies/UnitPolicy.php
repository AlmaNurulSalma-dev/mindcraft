<?php

namespace App\Policies;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UnitPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Unit $unit): bool
    {
        return $user->can('view', $unit->course);
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isMentor();
    }

    public function update(User $user, Unit $unit): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa update unit dari course yang di-assign
        if ($user->isMentor()) {
            return $unit->course->mentorships()
                ->where('mentor_id', $user->id)
                ->where('status', 'active')
                ->exists();
        }

        return false;
    }

    public function delete(User $user, Unit $unit): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Unit $unit): bool
    {
        return false;
    }

    public function forceDelete(User $user, Unit $unit): bool
    {
        return false;
    }
}
