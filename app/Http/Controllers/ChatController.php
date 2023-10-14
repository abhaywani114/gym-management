<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use \Auth;
use Illuminate\Http\Request;
use DB;
class ChatController extends Controller
{
    public function chat(Request $request, $user_id = null) {
        $user_id_followers = Auth::user()->followers->pluck('user_id')->toArray();
        $user_id_following = Auth::user()->following->pluck('follows')->toArray();
        $user_ids = array_merge($user_id_following, $user_id_followers);
        $data = User::whereIn('id', $user_ids)->get();
        $selected_user = User::find($user_id);
        $myUserId = Auth::user()->id;
        $messages = !empty($selected_user) ? Message::where(function ($query) use ($selected_user) {
            $query->where('from', Auth::user()->id)
                ->where('to', $selected_user->id);
        })->orWhere(function ($query) use ($selected_user) {
            $query->where('to', Auth::user()->id)
                ->where('from', $selected_user->id);
        })->orderBy('created_at', 'desc')->get() : [];
        return view('chat.chat', compact('data', 'selected_user', 'messages'));
    }
    public function sendMessage(Request $request) {
        Message::create([
            'from' => Auth::user()->id,
            'to' => $request->selected_user,
            'message' => $request->message
        ]);
        return back();
    }
}
