<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Detail_Orders;

class OrderController extends Controller
{
    public function DataOrders()
    {
        $order = Orders::all();
        return view('Dashboard.Orders.index', compact('order'));
    }

    public function approveOrder(Request $request, $id)
    {
        $order = Orders::where('id', $id)->first();
        $order->status = 'Order Approve';

        $order->save();

        return response()->json([
            'success' => 1,
            'message' => 'data order status update',
            'data' => $order
        ]);
    }

    public function FinishOrder(Request $request, $id)
    {
        $order = Orders::where('id', $id)->first();
        $order->status = 'Order Finish';

        $order->save();

        return response()->json([
            'success' => 1,
            'message' => 'data order status update',
            'data' => $order
        ]);
    }

    public function invoice($id)
    {
        $dec = decrypt($id);
        $order = Orders::find($dec);
        $count = Detail_Orders::where('id_order', $order->id)->count();

        return view('Dashboard.Orders.invoiceOrder', compact('order', 'count'));
    }

    public function DeleteOrder($id)
    {
        $dec = decrypt($id);
        $order = Orders::find($dec);
        $order->delete();

        return redirect()->back()->with('Success', 'Data Order Success To Delete');
    }
}
