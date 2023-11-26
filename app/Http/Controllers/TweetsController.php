<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TweetsController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('tweets.index', [
            'tweets' => auth()
                ->user()
                ->timeline(),
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
        ]);

        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body'],
        ]);

        return redirect()->route('home');
    }
}
