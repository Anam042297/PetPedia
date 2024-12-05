<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        // Get the count of active users
        $Users = User::where('role', '!=', 'admin')->count();
        $totalPosts = Post::count();
        $totalProducts = Product::count();
        $pendingOrdersCount = Order::where('status', '=', 'pending')->count();
        $pendingOrders = Order::where('status', '=', 'pending')->get();
        $activeUsersCount =User::where('is_active', 1)
        ->where('role', 'user')->get();
        $activeUsers = User::where('is_active', 1)
                             ->where('role', 'user')->get();
        return view('dashboard.dash', compact(
            'totalPosts',
            'totalProducts',
            'pendingOrdersCount',
            'pendingOrders',
            'activeUsersCount',
            'activeUsers',
            'Users',


        ));
    }
    public function edit()
    {
        $admin = Auth::user();
        return view('dashboard.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin = Auth::user();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }
        $admin->save();

        return redirect()->route('admin.index');
    }
    public function view()
    {
        return view('dashboard.profile.view');
    }
}
