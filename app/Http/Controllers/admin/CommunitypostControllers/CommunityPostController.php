<?php

namespace App\Http\Controllers\admin\CommunitypostControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityPostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        CommunityPost::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
        ]);

        return back();
    }

    public function destroy(CommunityPost $communityPost)
    {
        $this->authorize('delete', $communityPost);
        $communityPost->delete();

        return back();
    }
}
