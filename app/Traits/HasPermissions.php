<?php

namespace App\Traits;

trait HasPermissions
{
    // Check apakah user bisa akses panel tertentu
    public function canAccessPanel(string $panel): bool
    {
        return match($panel) {
            'admin' => $this->isAdmin(),
            'mentor' => $this->isMentor(),
            'mentee' => $this->isMentee(),
            default => false,
        };
    }

    // Admin Permissions
    public function canManageUsers(): bool
    {
        return $this->isAdmin();
    }

    public function canManageAllCourses(): bool
    {
        return $this->isAdmin();
    }

    public function canManageCategories(): bool
    {
        return $this->isAdmin();
    }

    public function canManageMentors(): bool
    {
        return $this->isAdmin();
    }

    public function canViewAllReports(): bool
    {
        return $this->isAdmin();
    }

    public function canManageSystemSettings(): bool
    {
        return $this->isAdmin();
    }

    // Mentor Permissions
    public function canManageOwnCourses(): bool
    {
        return $this->isMentor();
    }

    public function canCreateContent(): bool
    {
        return $this->isAdmin() || $this->isMentor();
    }

    public function canViewAssignedStudents(): bool
    {
        return $this->isMentor();
    }

    public function canGradAssignments(): bool
    {
        return $this->isMentor();
    }

    public function canGenerateReports(): bool
    {
        return $this->isAdmin() || $this->isMentor();
    }

    // Mentee Permissions
    public function canEnrollCourse(): bool
    {
        return $this->isMentee();
    }

    public function canSubmitAssignment(): bool
    {
        return $this->isMentee();
    }

    public function canAskQuestion(): bool
    {
        return $this->isMentee();
    }

    public function canViewOwnProgress(): bool
    {
        return $this->isMentee();
    }

    public function canAccessCourseContent(): bool
    {
        return $this->isMentee();
    }

    // Helper untuk check specific course access
    public function canAccessCourse($courseId): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        if ($this->isMentor()) {
            return $this->mentorships()
                ->where('course_id', $courseId)
                ->where('status', 'active')
                ->exists();
        }

        if ($this->isMentee()) {
            return $this->registrations()
                ->where('course_id', $courseId)
                ->whereIn('status', ['active', 'completed'])
                ->exists();
        }

        return false;
    }
}