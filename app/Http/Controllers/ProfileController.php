<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.index');
    }

    public function edit()
    {
        return view('user.profile.edit');
    }

    public function update(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $profilePicture = auth()->user()->profile_picture;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $profilePicture = $file->store('profile-pictures', 'public');

            // Delete old profile picture if exists
            if (auth()->user()->profile_picture) {
                Storage::disk('public')->delete(auth()->user()->profile_picture);
            }
        }

        auth()->user()->update([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'profile_picture' => $profilePicture,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
