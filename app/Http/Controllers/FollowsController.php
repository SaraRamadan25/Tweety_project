<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store(User $user): RedirectResponse
    {
    auth()
        ->user()
        ->toggleFollow($user);
        return back();
    }
}
