<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return true; 
    }

    public function view(User $user, Course $course): bool
    {
        if ($user->isAdmin()){
            return true;
        }

        if ($user->isMentor()) {
            return $course->mentorships()
                ->where('mentor_id', $user->id)
                ->exists();
        }

        if ($user->isMentee()) {
            return $course->registrations()
                ->where('user_id', $user->id)
                ->exists();
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isMentor()) {
            return $course->mentorships()
                ->where('mentor_id', $user->id)
                ->where('status', 'active')
                ->exists();
        }

        return false;
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Course $course): bool
    {
        return false;
    }

    public function forceDelete(User $user, Course $course): bool
    {
        return false;
    }
}
