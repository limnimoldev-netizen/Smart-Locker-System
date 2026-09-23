<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        $totalUsers = $users->count();
        $activeUsers = User::where('role', 'user')->count();
        $adminUsers = User::where('role', 'admin')->count();
        $totalSessions = $totalUsers * 3;

        return view('users.index', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'adminUsers',
            'totalSessions'
        ));
    }
}
