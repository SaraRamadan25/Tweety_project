<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Followable
{

    public function follow(User $user): Model
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user): int
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user): void
    {

       $this->follows()->toggle($user);
    }

    public function following(User $user): bool
    {
        return $this->follows()
            ->where('following_user_id', $user->id)
            ->exists();
    }

    public function follows(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'following_user_id'
        );
    }
}
