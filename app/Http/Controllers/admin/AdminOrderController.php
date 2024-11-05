<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AdminOrderController extends Controller
{
    // Display the orders list view
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::select(['id', 'tracking_id', 'total_amount', 'status', 'name', 'city', 'phone_no']);
            
            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    //  return '<a href="'.route('orders.show', $order->id).'" class="btn btn-primary btn-sm">View Details</a>';
                    $viewButton = '<a href="'.route('orders.show', $order->id).'" class="btn btn-primary btn-sm">View Details</a>';
                
                    // Dropdown for updating status
                    $statusDropdown = '
                        <select class="status-dropdown form-control" data-order-id="'.$order->id.'">
                            <option value="pending" '.($order->status == 'pending' ? 'selected' : '').'>Pending</option>
                            <option value="processing" '.($order->status == 'processing' ? 'selected' : '').'>Processing</option>
                            <option value="completed" '.($order->status == 'completed' ? 'selected' : '').'>Completed</option>
                            <option value="canceled" '.($order->status == 'canceled' ? 'selected' : '').'>Canceled</option>
                        </select>';
    
                    return $viewButton . ' ' . $statusDropdown;
                })
                
                ->rawColumns(['action'])  // Ensure HTML is rendered
                ->make(true);
        }
        return view('frontend.orders.view');
      
    }

    public function show($id)
    {
        // Fetch the order by ID
        $order = Order::findOrFail($id);
    
        // Return a view with the order details
        return view('frontend.orders.show', compact('order'));
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

}