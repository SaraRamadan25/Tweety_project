<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FollowsController extends Controller
{
    public function store(User $user): RedirectResponse
    {
        $currentUser = auth()->user();

        $currentUser->toggleFollow($user);

        $flashMessage = $currentUser->following($user)
            ? 'You have followed ' . $user->name
            : 'You have unfollowed ' . $user->name;

        Session::flash('success', $flashMessage);

        return back();
    }

}
