<?php

namespace App\Policies;

use App\Models\EssaySubmission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EssaySubmissionPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, EssaySubmission $essaySubmission): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa lihat submission dari course yang di-assign
        if ($user->isMentor()) {
            return $essaySubmission->lesson->unit->course->mentorships()
                ->where('mentor_id', $user->id)
                ->exists();
        }

        // Mentee bisa lihat submission sendiri
        if ($user->isMentee()) {
            return $essaySubmission->user_id === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        // Hanya mentee yang bisa submit
        return $user->isMentee();
    }

    public function update(User $user, EssaySubmission $essaySubmission): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentor bisa update (grade) submission
        if ($user->isMentor()) {
            return $essaySubmission->lesson->unit->course->mentorships()
                ->where('mentor_id', $user->id)
                ->exists();
        }

        // Mentee bisa update submission sendiri (jika belum di-grade)
        if ($user->isMentee() && !$essaySubmission->score) {
            return $essaySubmission->user_id === $user->id;
        }

        return false;
    }

    public function delete(User $user, EssaySubmission $essaySubmission): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentee bisa delete submission sendiri jika belum di-grade
        if ($user->isMentee() && !$essaySubmission->score) {
            return $essaySubmission->user_id === $user->id;
        }

        return false;
    }

    public function restore(User $user, EssaySubmission $essaySubmission): bool
    {
        return false;
    }

    public function forceDelete(User $user, EssaySubmission $essaySubmission): bool
    {
        return false;
    }
}
