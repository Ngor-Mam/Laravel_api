<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderShowResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::list();
        $orders = OrderResource::collection($orders);
        return response()->json(['status' => true, 'data' =>$orders], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Order::store($request);
        return response()->json(['status' => true, 'message' =>"Order created successfully"], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        $order = new OrderShowResource($order);
        return response()->json(['status' => true, 'data' =>$order], 200);


        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        Order::store($request, $id);
        return response()->json(['status' => true, 'message' =>"Order updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order= Order::find($id);
        $order->delete();
        return response()->json(['status' => true, 'message' =>"Order deleted successfully"], 200);
    }
}
