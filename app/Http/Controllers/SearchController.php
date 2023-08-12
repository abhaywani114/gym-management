<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search_key = $request->search;
        if (empty($search_key)) abort(404);
        $data = User::where('first_name','like', "%$search_key%")->get();
        $data = $data->map(function ($u) use ($request) {
            $u->isFollowing = !empty(
                Follow::where([
                    'user_id' => $request->user()->id,
                    'follows' => $u->id
                ])->first()
            );
            return $u;
        });
        return view('search', compact('search_key', 'data'));
    }

    public function toggleFollow(Request $request, $follow_id) {
        $isFollowing = Follow::where([
            'user_id' => $request->user()->id,
            'follows' => $follow_id
        ])->first();
        if (empty($isFollowing))
            Follow::create([
                'user_id' => $request->user()->id,
                'follows' => $follow_id
            ]);
        else
            $isFollowing->delete();

        return back();
    }
}
