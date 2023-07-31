<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function profile(Request $request, $userId) {
        $user = User::findOrFail($userId);
        return view('profile.timeline', compact('user'));
    }

    public function details(Request $request, $userId) {
        $user = User::findOrFail($userId);
        return view('profile.details', compact('user'));
    }

    public function calendar(Request $request, $userId) {
        $user = User::findOrFail($userId);
        return view('profile.calendar', compact('user'));
    }

    public function settings(Request $request, $userId) {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }
}
