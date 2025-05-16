<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
{
    public function viewAny(User $user): bool
    {
        // Admin dan mentor bisa lihat list payment
        return $user->isAdmin() || $user->isMentor();
    }

    public function view(User $user, Payment $payment): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Mentee bisa lihat payment sendiri
        if ($user->isMentee()) {
            return $payment->user_id === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        // Payment biasanya dibuat oleh system/gateway
        return $user->isAdmin();
    }

    public function update(User $user, Payment $payment): bool
    {
        // Hanya admin yang bisa update payment
        return $user->isAdmin();
    }

    public function delete(User $user, Payment $payment): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Payment $payment): bool
    {
        return false;
    }

    public function forceDelete(User $user, Payment $payment): bool
    {
        return false;
    }
}
