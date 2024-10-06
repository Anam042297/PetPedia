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

    public function index(){
            // Get the count of active users
    $activeUsers= User::where('role', '!=', 'admin')->count();
    ;

    // Fetch other data as needed
    $totalPosts = Post::count();
    $totalProducts = Product::count();
    $pendingOrders = Order::where('status', '=', 'pending')->count();
    $activePosts = Post::count();

    // Fetch recent activity
    $recentPosts = Post::latest()->take(5)->get();
    // $recentFoodItems = Food::latest()->take(5)->get();
    // $recentAccessories = Accessory::latest()->take(5)->get();

    return view('dashboard.dash', compact(
        'totalPosts',
        'totalProducts',
        'pendingOrders',
        'activeUsers',
        // 'activePosts',
        'recentPosts',
        // 'recentFoodItems',
        // 'recentAccessories'


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
    public function view(){
         return view('dashboard.profile.view');
    }
   

}
