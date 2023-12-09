<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user
                ->tweets()
                ->withLikes()
                ->paginate(50),
        ]);
    }

    public function edit(User $user): Factory|View|Application
    {
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user, UpdateProfileRequest $request):Redirector|Application|RedirectResponse
    {
        $attributes = $request->validated();
        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }
        if (request('banner')) {
            $attributes['banner'] = request('banner')->store('banners');
        }

        $user->update($attributes);

        return redirect($user->path());
    }

}
