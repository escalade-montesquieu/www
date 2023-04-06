<?php

namespace App\Observers;

use App\Enums\ImageSize;
use App\Models\User;

class UserObserver
{
    public function saving(User $user): void
    {
        User::withoutEvents(static function () use (&$user) {
            $user->optimize(ImageSize::TINY);
        });
    }
}
