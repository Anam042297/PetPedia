<?php

namespace App\Http\Controllers\admin\CommunitypostControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $post->replies()->create([
            'message' => $validated['message'],
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();

        return back();
    }
}
