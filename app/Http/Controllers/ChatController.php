<?php

namespace App\Http\Controllers;

use App\Models\User;
use \Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request) {
        $user_id_followers = Auth::user()->followers->pluck('user_id')->toArray();
        $user_id_following = Auth::user()->following->pluck('follows')->toArray();
        $user_ids = array_merge($user_id_following, $user_id_followers);
        $data = User::whereIn('id', $user_ids)->get();
        return view('chat.chat', compact('data'));
    }
}
