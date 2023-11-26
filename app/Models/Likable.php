<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Likable
{
    public function scopeWithLikes(Builder $query): void
    {
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(disliked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function isLikedBy(User $user): bool
    {
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function isDislikedBy(User $user): bool
    {
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', false)
            ->count();
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function dislike($user = null): void
    {
        $this->like($user, false, true);
    }

    public function like($user = null, $liked = true, $disliked = false): void
    {
        $like = $this->likes()->where('user_id', $user ? $user->id : auth()->id())->first();

        if ($like) {
            $like->update([
                'liked' => $liked,
                'disliked' => $disliked,
            ]);
        } else {
            $this->likes()->create([
                'user_id' => $user ? $user->id : auth()->id(),
                'liked' => $liked,
                'disliked' => $disliked,
            ]);
        }
    }

}
