<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AdminOrderController extends Controller
{
    // // Show all orders in DataTables
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::with('user', 'orderItems.petProduct')->get();

            return DataTables::of($orders)
                ->addColumn('user', function($order) {
                    return $order->user->name;
                })
                ->addColumn('total_amount', function($order) {
                    return '$' . number_format($order->total_amount, 2);
                })
                ->addColumn('status', function($order) {
                    return ucfirst($order->status);
                })
                ->addColumn('order_date', function($order) {
                    return $order->created_at->format('Y-m-d');
                })
                ->addColumn('action', function($order) {
                    return '
                        <a href="'.route('admin.orders.show', $order->id).'" class="btn btn-info btn-sm">View</a>
                        <form action="'.route('admin.orders.updateStatus', $order->id).'" method="POST" class="d-inline">
                            '.csrf_field().method_field('PATCH').'
                            <select name="status" class="form-control form-control-sm">
                                <option value="pending" '.($order->status == 'pending' ? 'selected' : '').'>Pending</option>
                                <option value="processing" '.($order->status == 'processing' ? 'selected' : '').'>Processing</option>
                                <option value="completed" '.($order->status == 'completed' ? 'selected' : '').'>Completed</option>
                                <option value="canceled" '.($order->status == 'canceled' ? 'selected' : '').'>Canceled</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm mt-1">Update</button>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.orders.index');
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