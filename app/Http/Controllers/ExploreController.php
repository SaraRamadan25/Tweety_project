<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('explore',[
            'users' =>User::paginate(50),
        ]);
    }
}
