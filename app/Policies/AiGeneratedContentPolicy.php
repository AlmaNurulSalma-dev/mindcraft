<?php

namespace App\Policies;

use App\Models\AiGeneratedContent;
use App\Models\User;

class AiGeneratedContentPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }
    public function view(User $user, AiGeneratedContent $aiGeneratedContent): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }
    public function update(User $user, AiGeneratedContent $aiGeneratedContent): bool
    {
        return false;
    }
    public function delete(User $user, AiGeneratedContent $aiGeneratedContent): bool
    {
        return false;
    }
    public function restore(User $user, AiGeneratedContent $aiGeneratedContent): bool
    {
        return false;
    }
    public function forceDelete(User $user, AiGeneratedContent $aiGeneratedContent): bool
    {
        return false;
    }
}
