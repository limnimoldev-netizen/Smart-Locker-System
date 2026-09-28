<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockerUsageController extends Controller
{
    public function index()
    {
        return view('user.usage.index');
    }
}
