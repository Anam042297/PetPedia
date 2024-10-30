<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AdminOrderController extends Controller
{
    // // Show all orders in DataTables
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $orders = Order::with('user', 'orderItems.petProduct')->get();

    //         return DataTables::of($orders)
    //             ->addColumn('user', function($order) {
    //                 return $order->user->name;
    //             })
    //             ->addColumn('total_amount', function($order) {
    //                 return '$' . number_format($order->total_amount, 2);
    //             })
    //             ->addColumn('status', function($order) {
    //                 return ucfirst($order->status);
    //             })
    //             ->addColumn('order_date', function($order) {
    //                 return $order->created_at->format('Y-m-d');
    //             })
    //             ->addColumn('action', function($order) {
    //                 return '
    //                     <a href="'.route('admin.orders.show', $order->id).'" class="btn btn-info btn-sm">View</a>
    //                     <form action="'.route('admin.orders.updateStatus', $order->id).'" method="POST" class="d-inline">
    //                         '.csrf_field().method_field('PATCH').'
    //                         <select name="status" class="form-control form-control-sm">
    //                             <option value="pending" '.($order->status == 'pending' ? 'selected' : '').'>Pending</option>
    //                             <option value="processing" '.($order->status == 'processing' ? 'selected' : '').'>Processing</option>
    //                             <option value="completed" '.($order->status == 'completed' ? 'selected' : '').'>Completed</option>
    //                             <option value="canceled" '.($order->status == 'canceled' ? 'selected' : '').'>Canceled</option>
    //                         </select>
    //                         <button type="submit" class="btn btn-success btn-sm mt-1">Update</button>
    //                     </form>';
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('dashboard.orders.index');
//     // }
//     public function index(Request $request)
// {
//     if ($request->ajax()) {
//         // Fetch orders for the authenticated user with related order items and products
//         $orders = Order::where('user_id', Auth::id())
//             ->with('orderItems.product')
//             ->get();

//         return DataTables::of($orders)
//             ->addColumn('tracking_id', function ($row) {
//                 return $row->tracking_id;
//             })
//             ->addColumn('total_amount', function ($row) {
//                 return number_format($row->total_amount, 2); // Format the total amount
//             })
//             ->addColumn('status', function ($row) {
//                 return ucfirst($row->status); // Capitalize the first letter
//             })
//             ->addColumn('name', function ($row) {
//                 return $row->name;
//             })
//             ->addColumn('city', function ($row) {
//                 return $row->city;
//             })
//             ->addColumn('phone_no', function ($row) {
//                 return $row->phone_no;
//             })
//             ->addColumn('action', function ($row) {
//                 // Customize actions, e.g., view or delete
//                 // $viewUrl = route('order.show', $row->id);
//                 // return '<a href="' . $viewUrl . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>';
//             })
//             ->removeColumn('id')
//             ->addIndexColumn()
//             ->rawColumns(['action'])
//             ->make(true);
//     }

//     return view('frontend.orders.view');
// }

    // Display the orders list view
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::select(['id', 'tracking_id', 'total_amount', 'status', 'name', 'city', 'phone_no']);
            
            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    // return '<a href="'.route('orders.show', $order->id).'" class="btn btn-primary btn-sm">View Details</a>';
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

}