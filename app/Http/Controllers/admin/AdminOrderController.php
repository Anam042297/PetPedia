<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AdminOrderController extends Controller
{
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $orders = Order::select(['id', 'tracking_id', 'total_amount', 'status', 'name', 'city', 'phone_no']);

    //         return DataTables::of($orders)
    //             ->addColumn('action', function ($order) {
    //                 $viewButton = '<a href="'.route('orders.show', $order->id).'" class="btn btn-primary btn-sm">Change Status</a>';
        
    //                 return $viewButton . ' ' ;
    //             })
                
    //             ->rawColumns(['action'])  // Ensure HTML is rendered
    //             ->make(true);
    //     }
    //     return view('frontend.orders.view');

    // }

    // // AdminOrderController.php
    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|in:pending,processing,completed,canceled',
    //     ]);

    //     $order = Order::findOrFail($id);
    //     $order->status = $request->status;
    //     $order->save();

    //     return redirect()->back()->with('success', 'Order status updated successfully!');
    // }
    // public function show($id)
    // {
    //     $order = Order::findOrFail($id);
    //     return view('frontend.orders.show', compact('order'));
    // }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::select(['id', 'tracking_id', 'total_amount', 'status', 'name', 'city', 'phone_no']);

            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    $viewButton = '<a href="'.route('orders.show', $order->id).'" class="btn btn-primary btn-sm">Change Status</a>';
        
                    return $viewButton . ' ' ;
                })
                
                ->rawColumns(['action'])  // Ensure HTML is rendered
                ->make(true);
        }
        return view('frontend.orders.view');

    }



    // AdminOrderController.php
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('frontend.orders.show', compact('order'));
    }

}

