<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LessonPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Lesson $lesson): bool
    {
        return $user->can('view', $lesson->unit->course);
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isMentor();
    }

    public function update(User $user, Lesson $lesson): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa update lesson dari course yang di-assign
        if ($user->isMentor()) {
            return $lesson->unit->course->mentorships()
                ->where('mentor_id', $user->id)
                ->where('status', 'active')
                ->exists();
        }

        return false;
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Lesson $lesson): bool
    {
        return false;
    }

    public function forceDelete(User $user, Lesson $lesson): bool
    {
        return false;
    }
}
