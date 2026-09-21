<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockerController extends Controller
{
    public function index()
    {
        return view('lockers.index');
    }

    public function create()
    {
        return view('lockers.create');
    }

    public function edit()
    {
        return view('lockers.edit');
    }

    public function show()
    {
        return view('lockers.show');
    }

    public function userIndex()
    {
        return view('user.lockers.index');
    }
}
