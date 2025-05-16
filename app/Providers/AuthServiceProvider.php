<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        \App\Models\Course::class => \App\Policies\CoursePolicy::class,
        \App\Models\Unit::class => \App\Policies\UnitPolicy::class,
        \App\Models\Lesson::class => \App\Policies\LessonPolicy::class,
        \App\Models\Mentorship::class => \App\Policies\MentorshipPolicy::class,
        \App\Models\Registration::class => \App\Policies\RegistrationPolicy::class,
        \App\Models\EssaySubmission::class => \App\Policies\EssaySubmissionPolicy::class,
        \App\Models\UserQuestion::class => \App\Policies\UserQuestionPolicy::class,
        \App\Models\Payment::class => \App\Policies\PaymentPolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    ];
}
