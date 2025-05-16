<?php

namespace App\Policies;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MentorPolicy
{

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Mentor $mentor): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Mentor $mentor): bool
    {
        return false;
    }

    public function delete(User $user, Mentor $mentor): bool
    {
        return false;
    }

    public function restore(User $user, Mentor $mentor): bool
    {
        return false;
    }

    public function forceDelete(User $user, Mentor $mentor): bool
    {
        return false;
    }
}
