<?php

namespace App\Http\Controllers;

use App\Models\Mention;
use App\Models\Notification;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class TweetsController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline(),
        ]);
    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'image' => 'file|mimes:jpeg,png,jpg,gif',
        ]);

        $imagePath = isset($attributes['image']) ? $attributes['image']->store('TweetsImages') : null;

        $tweet = auth()->user()->tweets()->create([
            'body' => $attributes['body'],
            'image' => $imagePath,
        ]);

        Session::flash('success', 'Tweet published successfully');

        $content = $attributes['body'];

        $pattern = "/@([A-Za-z0-9_\.]+)/";
        preg_match_all($pattern, $content, $matches);

        $mentionedUsers = $matches[1];

        if ($mentionedUsers) {
            foreach ($mentionedUsers as $mentionedUser) {
                $user = User::where('username', $mentionedUser)->first();

                if ($user) {
                    Mention::create([
                        'user_id' => $user->id,
                        'tweet_id' => $tweet->id,
                    ]);

                    Notification::create([
                        'user_id' => $user->id,
                        'message' => 'You were mentioned in a post.',
                        'tweet_id' => $tweet->id,
                    ]);
                }
            }
        }

        return redirect()->route('home');
    }

    public function destroy(Tweet $tweet): RedirectResponse
    {
        $tweet->delete();
        Session::flash('success', 'Tweet deleted successfully');

        return back();
    }
}
