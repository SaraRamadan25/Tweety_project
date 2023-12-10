<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
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
        auth()->user()->tweets()->create([
            'body' => $attributes['body'],
            'image' => $imagePath,
        ]);
        Session::flash('success', 'Tweet published successfully');

        return redirect()->route('home');
    }
}
