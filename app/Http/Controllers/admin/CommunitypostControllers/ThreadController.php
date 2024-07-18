<?php

namespace App\Http\Controllers\admin\CommunitypostControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function index(){
    // {return 'thread is working';
        $threads = Thread::with(['user', 'posts.replies.user', 'posts.reactions'])->latest()->paginate(10);
        // dd($threads);
        return view('frontend.blog', ['threads'=>$threads]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Thread::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
        ]);

        return back();
    }

    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();

        return back();
    }
}
